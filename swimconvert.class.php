<?php
/**
 * Swim Conversions PHP Class
 *
 * This class provides conversions from long course to short course and vice-versa.
 * It can be used with different sets of conversion factors.
 * The class also handles altitude conversion for longer events.
 *
 *   Copyright (C) 2013 Brian Stanback
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Brian Stanback
 * @copyright Brian Stanback 2013
 * @version 3.0.0
 * @license GPLv3
 * @link http://www.brianstanback.com/
 */
class SwimConvert {
    /**
     * @var array Data structure containing the available conversion factors.
     *     SCY = Short course yards
     *     SCM = Short course meters
     *     LCM = Long course meters
     *     ALT = Altitude
     *     50, 100, 200, 400/500, 800/1000, 1500/1650 = The various distances
     *     $x = The time in seconds (malicious input filtered, dynamically replaced when converting)
     * @access public
     */
    public static $factors = array(
        //
        // Begin: CO factor set
        //
        //     The set of factors published by Colorado Swimming
        //     Source: http://www.csi.org/conversions.aspx
        //     (Additional sets of factors could be added if desired)
        //
        'CO' => array(
            'Butterfly' => array(
                50 => array(
                    'SCY_LCM' => '$x * 1.11 + 0.7',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 0.7) / 1.11',
                    'LCM_SCM' => '$x - 0.7',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 0.7',
                ),
                100 => array(
                    'SCY_LCM' => '$x * 1.11 + 1.4',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 1.4) / 1.11',
                    'LCM_SCM' => '$x - 1.4',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 1.4',
                ),
                200 => array(
                    'SCY_LCM' => '$x * 1.11 + 2.6',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 2.8) / 1.11',
                    'LCM_SCM' => '$x - 2.8',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 2.8',
                ),
            ),
            'Backstroke' => array(
                50 => array(
                    'SCY_LCM' => '$x * 1.11 + 0.6',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 0.6) / 1.11',
                    'LCM_SCM' => '$x - 0.6',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 0.6',
                ),
                100 => array(
                    'SCY_LCM' => '$x * 1.11 + 1.2',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 1.2) / 1.11',
                    'LCM_SCM' => '$x - 1.2',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 1.2',
                ),
                200 => array(
                    'SCY_LCM' => '$x * 1.11 + 2.4',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 2.4) / 1.11',
                    'LCM_SCM' => '$x - 2.4',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 2.4',
                ),
            ),
            'Breaststroke' => array(
                50 => array(
                    'SCY_LCM' => '$x * 1.11 + 1.0',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 1.0) / 1.11',
                    'LCM_SCM' => '$x - 1.0',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 1.0',
                ),
                100 => array(
                    'SCY_LCM' => '$x * 1.11 + 2.0',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 2.0) / 1.11',
                    'LCM_SCM' => '$x - 2.0',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 2.0',
                ),
                200 => array(
                    'SCY_LCM' => '$x * 1.11 + 4.0',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 4.0) / 1.11',
                    'LCM_SCM' => '$x - 4.0',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 4.0',
                ),
            ),
            'Freestyle' => array(
                50 => array(
                    'SCY_LCM' => '$x * 1.11 + 0.8',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 0.8) / 1.11',
                    'LCM_SCM' => '$x - 0.8',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 0.8',
                ),
                100 => array(
                    'SCY_LCM' => '$x * 1.11 + 1.6',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 1.6) / 1.11',
                    'LCM_SCM' => '$x - 1.6',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 1.6',
                ),
                200 => array(
                    'SCY_LCM' => '$x * 1.11 + 3.2',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 3.2) / 1.11',
                    'LCM_SCM' => '$x - 3.2',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 3.2',
                    'ALT' => array(
                        '3000' => '$x - 0.5',
                        '4251' => '$x - 1.2',
                        '6501' => '$x - 1.6',
                    ),
                ),
                '400/500' => array(
                    'SCY_LCM' => '$x * 0.8925',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '$x / 0.8925',
                    'LCM_SCM' => '$x - 6.4',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 6.4',
                    'ALT' => array(
                        '3000' => '$x - 2.5',
                        '4251' => '$x - 5.0',
                        '6501' => '$x - 7.0',
                    ),
                ),
                '800/1000' => array(
                    'SCY_LCM' => '$x * 0.8925',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '$x / 0.8925',
                    'LCM_SCM' => '$x - 12.8',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 12.8',
                    'ALT' => array(
                        '3000' => '$x - 5.0',
                        '4251' => '$x - 10.0',
                        '6501' => '$x - 15.0',
                    ),
                ),
                '1500/1650' => array(
                    'SCY_LCM' => '$x * 1.02',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '$x / 1.02',
                    'LCM_SCM' => '$x - 24.0',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 24.0',
                    'ALT' => array(
                        '3000' => '$x - 11.0',
                        '4251' => '$x - 23.0',
                        '6501' => '$x - 32.5',
                    ),
                ),
            ),
            'Ind. Medley' => array(
                200 => array(
                    'SCY_LCM' => '$x * 1.11 + 3.2',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 3.2) / 1.11',
                    'LCM_SCM' => '$x - 3.2',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 3.2',
                ),
                400 => array(
                    'SCY_LCM' => '$x * 1.11 + 6.4',
                    'SCY_SCM' => '$x * 1.11',
                    'LCM_SCY' => '($x - 6.4) / 1.11',
                    'LCM_SCM' => '$x - 6.4',
                    'SCM_SCY' => '$x / 1.11',
                    'SCM_LCM' => '$x + 6.4',
                ),
            ),
            'Free Relay' => array(
                800 => array(
                    'ALT' => array(
                        '3000' => '$x - 2.0',
                        '4251' => '$x - 4.8',
                        '6501' => '$x - 6.4',
                    ),
                ),
            ),
        ),
        //
        // End: CO factor set
        //
    );

    /**
     * @var string The name of the factor set to use, selected when constructing the class.
     */
    private $_active_factor_set;

    /**
     * @var array An array containing information about the current conversion
     */
    private $_current_conversion;

    /**
     * @var array The error message if a conversion failed or invalid data was posted
     */
    private $_current_conversion_errors;

    /**
     * The class constructor which initializes the class with the specified set
     * of factors.
     *
     * @param string $factor_set The name of the factor set
     * @access public
     */
    public function __construct($factor_set = 'CO') {
        if (!isset(self::$factors[$factor_set])) {
            die('The factor set was not found: ' . $factor_set);
        }

        $this->_active_factor_set = $factor_set;
        $this->_current_conversion_errors = array();
    }

    /**
     * Get the conversion details and set them in the $_current_conversion
     * class variable (if the user submitted the form).
     *
     * @access public
     */
    public function get_post_data() {
        // Check whether the form was submitted
        if (isset($_POST['convert'])) {
            // Get the time
            $minutes    = isset($_POST['minutes'])   ? abs(intval($_POST['minutes']))    : 0;
            $seconds    = isset($_POST['seconds'])   ? abs(intval($_POST['seconds']))    : 0;
            $hundredths = isset($_POST['hunredths']) ? abs(intval($_POST['hundredths'])) : 0;

            // Get the conversion details
            $event               = isset($_POST['event'])               ? $_POST['event']               : '';
            $course_from         = isset($_POST['course_from'])         ? $_POST['course_from']         : '';
            $course_to           = isset($_POST['course_to'])           ? $_POST['course_to']           : '';
            $altitude_adjustment = isset($_POST['altitude_adjustment']) ? $_POST['altitude_adjustment'] : '';

            // Error detection
            if (($minutes <= 0 && $seconds <= 0 && $hundredths <= 0) || empty($event) || strpos($event, '_') === false) {
                // No time entered
                $this->_current_conversion_errors[] = 'Please enter a time to convert.';
            } elseif ((!empty($course_from) && !empty($course_to)) && $course_from == $course_to) {
                // To and from course are the same
                $this->_current_conversion_errors[] = 'The courses to convert from/to are identical.';
            } elseif ((!empty($course_from) && empty($course_to)) || (empty($course_from) && !empty($course_to))) {
                // No to/from course entered
                $this->_current_conversion_errors[] = 'Please specify both the course to convert from and the course to convert to.';
            } elseif ((empty($course_from) || empty($course_to)) && empty($altitude_adjustment)) {
                // No course entered and no altitude conversion
                $this->_current_conversion_errors[] = 'Please specify the course conversion and/or an altitude adjustment.';
            }

            // Set the current conversion details to the class variable for processing by other methods
            list($distance, $stroke) = explode('_', $event, 2);
            $this->_current_conversion = array(
                'minutes'             => $minutes,
                'seconds'             => $seconds,
                'hundredths'          => $hundredths,
                'time'                => (($minutes * 60) + $seconds + ($hundredths / 100)),
                'event'               => $event,
                'stroke'              => $stroke,
                'distance'            => $distance,
                'course_from'         => $course_from,
                'course_to'           => $course_to,
                'altitude_adjustment' => $altitude_adjustment,
            );
        }
    }

    /**
     * Display the conversions form.
     *
     * @return string The HTML form for performing time conversions.
     * @access public
     */
    public function get_form() {
        // Select the factor set
        $factors = &self::$factors[$this->_active_factor_set];

        // The form action URL
        $form_action = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $PHP_SELF;

        // Generate the minutes field
        $default_minutes = isset($this->_current_conversion['minutes']) ? sprintf('%02d', $this->_current_conversion['minutes']) : '00';
        $minutes_field = '<input type="text" id="convert-minutes" name="minutes" size="2" maxlength="2" value="' . $default_minutes . '" onfocus="this.select()" />';

        // Generate the seconds field
        $default_seconds = isset($this->_current_conversion['seconds']) ? sprintf('%02d', $this->_current_conversion['seconds']) : '00';
        $seconds_field = '<input type="text" id="convert-seconds" name="seconds" size="2" maxlength="2" value="' . $default_seconds . '" onfocus="this.select()" />';

        // Generate the hundredths field
        $default_hundredths = isset($this->_current_conversion['hundredths']) ? sprintf('%02d', $this->_current_conversion['hundredths']) : '00';
        $hundredths_field = '<input type="text" id="convert-hundredths" name="hundredths" size="2" maxlength="2" value="' . $default_hundredths . '" onfocus="this.select()" />';

        // Generate the event select field
        $default_event = isset($this->_current_conversion['event']) ? $this->_current_conversion['event'] : '';
        $event_select = '<select id="convert-event" name="event"><option value="">Event</option>';
        foreach ($factors as $stroke => $distances) {
            foreach (array_keys($distances) as $distance) {
                if ($distance . '_' . $stroke == $default_event) {
                    $event_select .= '<option value="' . $distance . '_' . $stroke . '" selected="selected">' . $distance . ' ' . $stroke . '</option>';
                } else {
                    $event_select .= '<option value="' . $distance . '_' . $stroke . '">' . $distance . ' ' . $stroke . '</option>';
                }
            }
        }
        $event_select .= '</select>';

        // The available courses to convert to and from
        $courses = array(
            'SCY' => 'Short Course Yards',
            'LCM' => 'Long Course Meters',
            'SCM' => 'Short Course Meters',
        );

        // Generate the starting course select field
        $default_course_from = isset($this->_current_conversion['course_from']) ? $this->_current_conversion['course_from'] : '';
        $course_from_select = '<select id="convert-course-from" name="course_from"><option value="">From</option>';
        foreach ($courses as $course_from => $course_from_name) {
            if ($course_from == $default_course_from) {
                $course_from_select .= '<option value="' . $course_from . '" selected="selected">' . $course_from_name . '</option>';
            } else {
                $course_from_select .= '<option value="' . $course_from . '">' . $course_from_name . '</option>';
            }
        }
        $course_from_select .= '</select>';

        // Generate the ending course select field
        $default_course_to = isset($this->_current_conversion['course_to']) ? $this->_current_conversion['course_to'] : '';
        $course_to_select = '<select id="convert-course-to" name="course_to"><option value="">To</option>';
        foreach ($courses as $course_to => $course_to_name) {
            if ($course_to == $default_course_to) {
                $course_to_select .= '<option value="' . $course_to . '" selected="selected">' . $course_to_name . '</option>';
            } else {
                $course_to_select .= '<option value="' . $course_to . '">' . $course_to_name . '</option>';
            }
        }
        $course_to_select .= '</select>';

        // The available altitudes to convert to and from
        // Note: this could be determined dynamically in a future version of this class
        $altitudes = array(
            3000 => '3000-4250 ft',
            4251 => '4251-6500 ft',
            6501 => '6500+ ft',
        );

        // Generate the altitude adjustment field
        $default_altitude_adjustment = isset($this->_current_conversion['altitude_adjustment']) ? $this->_current_conversion['altitude_adjustment'] : '';
        $altitude_select = '<select id="convert-altitude-adjustment" name="altitude_adjustment"><option value="">No Altitude Adjustment</option>';
        foreach ($altitudes as $starting_altitude => $altitude) {
            if ($starting_altitude == $default_altitude_adjustment) {
                $altitude_select .= '<option value="' . $starting_altitude . '" selected="selected">' . $altitude . ' to Sea Level</option>';
            } else {
                $altitude_select .= '<option value="' . $starting_altitude . '">' . $altitude . ' to Sea Level</option>';
            }
        }
        $altitude_select .= '</select>';

        // Return the form's HTML code
        return <<<EOF
        <form action="{$form_action}" method="post">

            <fieldset>

                <input type="hidden" name="convert" value="1" />

                <label for="convert-event" class="select">
                    {$event_select}
                </label>

                <div class="label">
                    {$minutes_field}:{$seconds_field}.{$hundredths_field} (mm:ss.hh)
                </div>

            </fieldset>

            <fieldset>

                <label for="convert-course-from" class="select">
                    {$course_from_select}
                </label>

                <label for="convert-course-to" class="select">
                    {$course_to_select}
                </label>

                <label for="convert-altitude-adjustment" class="select">
                    {$altitude_select}
                </label>

            </fieldset>

            <fieldset>

                <input type="submit" value="Convert" />

            </fieldset>

        </form>
EOF;
    }

    /**
     * Output the converted time, displaying any applicable error messages.
     *
     * @return string The converted time if the user was performing a conversion, otherwise return an empty string.
     * @access public
     */
    public function get_converted_time() {
        if (!empty($this->_current_conversion_errors)) {
            // Return input errors
            return '<p class="swim-convert-error"><em>' . implode('<br />', $this->_current_conversion_errors) . '</em></p>';
        } elseif (!isset($this->_current_conversion)) {
            // Return nothing if no conversion was posted
            return '';
        }

        // Convert the time
        $converted_time = $this->_current_conversion['time'];
        $converted_time = $this->convert_altitude($this->_current_conversion['stroke'], $this->_current_conversion['distance'], $converted_time, $this->_current_conversion['altitude_adjustment']);
        $converted_time = $this->convert_time($this->_current_conversion['stroke'], $this->_current_conversion['distance'], $converted_time, $this->_current_conversion['course_from'], $this->_current_conversion['course_to']);

        // Extract the minute, second, and hundredths components
        $minutes = sprintf('%02d', intval($converted_time / 60));
        $seconds = sprintf('%02d', intval($converted_time - ($minutes * 60)));
        $hundredths = sprintf('%02d', intval(($converted_time - (($minutes * 60) + $seconds)) * 100));

        // Return the result
        $errors = '';
        if (!empty($this->_current_conversion_errors)) {
            $errors = '<p class="swim-convert-error"><em>' . implode('<br />', $this->_current_conversion_errors) . '</em></p>' . "\n\n";
        }
        return $errors . '<p class="swim-convert-time">Converted time: <strong>' . $minutes . ':' . $seconds . '.' . $hundredths . '</strong></p>';
    }

    /**
     * Convert swim times to and from meters, yards, long course, and short course.
     *
     * @param $stroke string The stroke, case-insensitive (Butterfly, Backstroke, Breaststroke, Freestyle, Ind. Medley, Relay)
     * @param $distance string The distance (50, 100, 200, 400/500, 800/1000, 1500/1650)
     * @param $time float The starting time, in seconds
     * @param $from string The starting course
     * @param $to string The ending course
     * @return float The converted time, in seconds
     * @access public
     */
    public function convert_time($stroke, $distance, $time, $from, $to) {
        if (empty($from) || empty($to)) {
            // No conversion necessary
            return $time;
        }

        // Select the appropriate factor
        if (!isset(self::$factors[$this->_active_factor_set][$stroke][$distance][$from . '_' . $to])) {
            // No course conversion factor found
            $this->_current_conversion_errors[] = 'No course conversion used for the specified stroke and distance.';
            return $time;
        }
        $factor = self::$factors[$this->_active_factor_set][$stroke][$distance][$from . '_' . $to];

        // Perform the conversion
        $x = floatval($time);
        eval('$y = (' . $factor . ');');

        // If conversion result is less than 0, return 0
        return ($y > 0) ? $y : 0;
    }

    /**
     * Convert to sea level time based on the specified starting altitude.
     *
     * @param $stroke string The stroke, case-sensitive (Butterfly, Backstroke, Breaststroke, Freestyle, Ind. Medley, Relay)
     * @param $distance string The distance (50, 100, 200, 400/500, 800/1000, 1500/1650)
     * @param $time float The starting time, in seconds
     * @param $starting_altitude int The starting altitude
     * @return float The converted time, in seconds
     * @access public
     */
    public function convert_altitude($stroke, $distance, $time, $starting_altitude) {
        if (empty($starting_altitude) || $starting_altitude <= 0) {
            // No conversion necessary
            return $time;
        }

        // Select the appropriate factor
        if (!isset(self::$factors[$this->_active_factor_set][$stroke][$distance]['ALT'][$starting_altitude])) {
            // No distance conversion factor found
            $this->_current_conversion_errors[] = 'No altitude conversion used for the specified stroke and distance.';
            return $time;
        }
        $factor = self::$factors[$this->_active_factor_set][$stroke][$distance]['ALT'][$starting_altitude];

        // Perform the conversion
        $x = floatval($time);
        eval('$y = (' . $factor . ');');

        // If conversion result is less than 0, return 0
        return ($y > 0) ? $y : 0;
    }
}
