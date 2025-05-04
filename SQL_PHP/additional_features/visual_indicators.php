<?php
function style_glucose_cell($value) {
    $color = '';

    if ($value >= 228) $color = '#cc0000'; // Very High - Red
    elseif ($value >= 105 && $value <= 170) $color = '#c9ab00'; // Medium - Yellow
    elseif ($value >= 76 && $value <= 104) $color = '#388E3C'; // Normal - Green
    elseif ($value >= 58 && $value <= 75) $color = '#c9ab00'; // Medium - Yellow
    else $color = '#cc0000'; // Very Low - Red

    return "<td class='indicator' style='background-color: $color;' data-color='$color'>$value</td>";
}

function style_bmi_cell($value) {
    $color = '';
    
    if ($value >= 35) $color = '#cc0000'; // Very High - Red
    elseif ($value >= 25 && $value <= 29) $color = '#c9ab00'; // Medium - Yellow
    elseif ($value >= 18.5 && $value <= 24) $color = '#388E3C'; // Normal - Green
    elseif ($value >= 17 && $value <= 18.4) $color = '#c9ab00'; // Medium - Yellow
    else $color = '#cc0000'; // Very Low - Red

    return "<td class='indicator' style='background-color: $color;' data-color='$color'>$value</td>";
}

function style_stroke_cell($value) {
    $color = '';
    
    if ($value >= 30) $color = '#cc0000'; // Very High - Red
    elseif ($value >= 10 && $value <= 29) $color = '#c9ab00'; // Medium - Yellow
    else $color = '#388E3C'; // Normal - Green

    return "<td class='indicator' style='background-color: $color;' data-color='$color'>$value</td>";
}

function style_smoking_cell($value) {
    $color = '';
    
    if ($value == 'smokes') $color = '#cc0000'; // Very High - Red
    elseif ($value == 'formerly_smoked') $color = '#c9ab00'; // Medium - Yellow
    elseif ($value == 'never_smoked') $color = '#388E3C'; // Normal - Green

    return "<td class='indicator' style='background-color: $color;' data-color='$color'>$value</td>";
}

function style_heart_and_hyper_cell($value) {
    $color = '';
    
    if ($value == 'Yes') $color = '#cc0000'; // Very High - Red
    elseif ($value == 'No') $color = '#388E3C'; // Normal - Green

    return "<td class='indicator' style='background-color: $color;' data-color='$color'>$value</td>";
}

function style_age_cell($value) {
    $color = '';
    
    if ($value >= 65) $color = '#cc0000'; // Very High - Red
    elseif ($value >= 40 && $value <= 64) $color = '#c9ab00'; // Medium - Yellow
    else $color = '#388E3C'; // Normal - Green

    return "<td class='indicator' style='background-color: $color;' data-color='$color'>$value</td>";
}
?>
