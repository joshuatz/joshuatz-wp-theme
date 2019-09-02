<?php
/**
 * Geo Locked Content
 */

class JTZWP_GeoLockedContent_Widget extends WP_Widget {
    public function __construct(){
        $widgetConfig = (object) array(
            'id' => 'jtzwp_geoLockedContent',
            'name' => 'Geo Locked Content (JTZWP)',
            'options' => array(
                'classname' => 'jtzwpGeoLockedContent',
                'description' => 'Displays content to users matching a certain Geographic area'
            )
        );
        // construct WP_Widget instance
        parent::__construct(
            $widgetConfig->id,
            $widgetConfig->name,
            $widgetConfig->options
        );
    }

    public function widget($args,$instance){
        // Outputs content

        global $jtzwpHelpers;

        // Get settings
        extract($args);
        $widgetId = $args['widget_id'];
        $widgetTitle = apply_filters('widget_title',$instance['title']);
        $useJavascript = !empty($instance['useJavascript']) ? $instance['useJavascript'] : false;
        $countryFilter = !empty($instance['countryFilter']) ? $instance['countryFilter'] : false;
        $regionFilter = !empty($instance['regionFilter']) ? $instance['regionFilter'] : false;
        $cityFilter = !empty($instance['cityFilter']) ? $instance['cityFilter'] : false;
        $actualContent = !empty($instance['actualContent']) ? $instance['actualContent'] : false;
        $hasFilter = ($countryFilter || $regionFilter || $cityFilter);
        $filters = array(
            array(
                'infoKey' => 'country',
                'filterVal' => $countryFilter
            ),
            array(
                'infoKey' => 'region',
                'filterVal' => $regionFilter
            ),
            array(
                'infoKey' => 'city',
                'filterVal' => $cityFilter
            )
        );

        // Flag if using backend fails in some way
        $backendFailed = false;
        // Flag if filters fail to match
        $matchBlocked = false;

        if (!$actualContent){
            // return immediately - nothing to show
            return;
        }

        if (!$useJavascript){
            $ipInfoResponse = $jtzwpHelpers->getIpInfo();
            if ($ipInfoResponse->success){
                // Go ahead and test for match
                $jtzwpHelpers->log($ipInfoResponse->info);
                foreach($filters as $filter){
                    if ($filter['filterVal']){
                        $ipInfoVal = $ipInfoResponse->info[$filter['infoKey']];
                        if ($jtzwpHelpers->autoStrMatchTest($filter['filterVal'],$ipInfoVal)===false){
                            $matchBlocked = true;
                            $jtzwpHelpers->log('blocked by ' . $filter['infoKey'] . ' - "' . $filter['filterVal'] . '" [not match] ' . $ipInfoVal);
                            break;
                        }
                    }
                }
            }
            else {
                $jtzwpHelpers->log($ipInfoResponse->failMsg);
                // Try to switch over to JS
                $backendFailed = true;
                $useJavascript = true;
            }
        }
        
        // If match blocked, return
        if ($matchBlocked){
            return;
        }

        // Before widget content
        echo $before_widget;

        ?>
        <div id="<?php echo $widgetId;?>-wrapper" class="wrapper animateOpacity <?php echo $hasFilter && $useJavascript ? 'hide' : ''?>">
        <?php

        // Title
        if (!empty($widgetTitle)){
            echo $before_title . $widgetTitle . $after_title;
        }
        ?>
        <?php /* Now output the actual inner widget content */ ?>
            <div class="widgetBody">
                <?php echo $actualContent; ?>
                <?php if($hasFilter && $useJavascript): ?>
                    <script>
                        // Need to refactor into global file which can be called from this, instead of echoing out script once per widget
                        (function(){
                            function strToRegExp(e){var r=/^\/(.*)\/([igmuy]{0,5})$/;if(r.test(e)){var n=r.exec(e)[1],t=r.exec(e)[2];return new RegExp(n,t)}return new RegExp(e)}
                            var filters = <?php echo json_encode($filters); ?>;
                            var widgetId = '<?php echo $widgetId; ?>';
                            var tokenSetting = <?php echo json_encode($jtzwpHelpers->getThemeUserSetting('jtzwp_ipinfo_token')); ?>;
                            var endPoint = 'https://ipinfo.io';
                            var xhr = new XMLHttpRequest();
                            xhr.addEventListener('load',function(){
                                if (xhr.status === 200){
                                    var matchBlocked = false;
                                    var ipInfo = JSON.parse(xhr.responseText);
                                    for (var x=0; x<filters.length; x++){
                                        var filter = filters[x];
                                        if (typeof(filter.filterVal)==='string'){
                                            if (!(filter.infoKey in ipInfo)){
                                                matchBlocked = true;
                                            }
                                            else {
                                                matchBlocked = strToRegExp(filter.filterVal).test(ipInfo[filter.infoKey])===false;
                                            }
                                        }
                                        if (matchBlocked){
                                            break;
                                        }
                                    }
                                    if (!matchBlocked){
                                        var wrapper = document.getElementById(widgetId + '-wrapper');
                                        wrapper.style.opacity = 0;
                                        wrapper.classList.remove('hide');
                                        setTimeout(function(){
                                            wrapper.style.opacity = 1;
                                        },100);
                                    }
                                }
                                else {
                                    if (isDebug){
                                        console.warn('Bad response from IpInfo:');
                                        console.log(res);
                                    }
                                }
                            });
                            xhr.open('GET',endPoint);
                            xhr.setRequestHeader('Accept','application/json');
                            if (tokenSetting.isValid){
                                xhr.setRequestHeader('Authorization','Bearer ' + tokenSetting.val);
                            }
                            xhr.send();
                        })();
                    </script>
                <?php endif; ?>
            </div>
        <?php /* END inner widget content */ ?>
        </div>
        <?php echo $after_widget;

    }

    public function form($instance){
        // Rendering the options form in the admin interface
        
        // Check for values already set by user
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $useJavascript = isset($instance['useJavascript']) ? (bool) $instance['useJavascript'] : false;
        $countryFilter = isset($instance['countryFilter']) ? esc_attr($instance['countryFilter']) : '';
        $regionFilter = isset($instance['regionFilter']) ? esc_attr($instance['regionFilter']) : '';
        $cityFilter = isset($instance['cityFilter']) ? esc_attr($instance['cityFilter']) : '';
        $actualContent = isset($instance['actualContent']) ? esc_attr($instance['actualContent']) : '';
        ?>
        <?php /* Ouptut the actual form HTML */ ?>
            <!-- Title -->
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <!-- Use JavaScript Checkbox -->
            <p>
                <input class="checkbox" type="checkbox"<?php checked($useJavascript);?> id="<?php echo $this->get_field_id('useJavascript'); ?>" name="<?php echo $this->get_field_name('useJavascript'); ?>" />
                <label for="<?php echo $this->get_field_id('useJavascript'); ?>"><?php _e('Use Javascript to hide content instead of backend'); ?></label>
            </p>
            <div class="widgetSubTitle">Filters</div>
            <p>Note that filters can be either plain strings (e.g. "seattle") or Regex patterns (e.g. "/seattle|portland/i")</p>
            <!-- Country Filter -->
            <p>
                <label for="<?php echo $this->get_field_id('countryFilter'); ?>"><?php _e('Country to filter to : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('countryFilter'); ?>" name="<?php echo $this->get_field_name('countryFilter'); ?>" type="text" value="<?php echo $countryFilter; ?>" />
            </p>
            <!-- Region Filter -->
            <p>
                <label for="<?php echo $this->get_field_id('regionFilter'); ?>"><?php _e('Region to filter to : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('regionFilter'); ?>" name="<?php echo $this->get_field_name('regionFilter'); ?>" type="text" value="<?php echo $regionFilter; ?>" />
            </p>
            <!-- City Filter -->
            <p></p>
                <label for="<?php echo $this->get_field_id('cityFilter'); ?>"><?php _e('City to filter to : '); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('cityFilter'); ?>" name="<?php echo $this->get_field_name('cityFilter'); ?>" type="text" value="<?php echo $cityFilter; ?>" />
            </p>
            <!-- The Actual Content -->
            <div class="widgetSubTitle">Actual Content:</div>
            <p>
                <label for="<?php echo $this->get_field_id('actualContent'); ?>"><?php _e('Actual HTML Content : '); ?></label>
                <textarea class="widefat code" rows="16" cols="20" id="<?php echo $this->get_field_id('actualContent'); ?>" name="<?php echo $this->get_field_name('actualContent'); ?>"><?php echo esc_textarea($instance['actualContent']); ?></textarea>
            </p>
        <?php
    }

    public function update($newInstance,$oldInstance){
        // When widget data updates
        return $newInstance;
    }
}
add_action('widgets_init',function(){register_widget('JTZWP_GeoLockedContent_Widget');});

