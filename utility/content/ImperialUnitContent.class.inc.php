<?

Loader::load('utility', 'Content');

final class ImperialUnitContent extends Content
{

    protected function execute($type = '')
    {
        $number = floatval($this->content);
        $number *= 39.37; // convert to inches
        
        if ($type == '') {
            if ($number > (12 * 3 * 1760 * 5)) {
                $type = 'full miles';
            } else if ($number > (12 * 3 * 1760 * .5)) {
                $type = 'tenth miles';
            } else if ($number > (12 * 3 * 150)) {
                $type = 'yards';
            } else if ($number > (12 * 10)) {
                $type = 'feet';
            } else {
                $type = 'inches';
            }
        }
        
        switch ($type) {
            case 'full miles' :
                $this->content = number_format(round($number / (12 * 3 * 1760))) . ' miles';
                break;
            case 'tenth miles' :
                $this->content = round($number / (12 * 3 * 1760), 1) . ' miles';
                break;
            case 'yards' :
                $this->content = number_format(round($number / (12 * 3))) . ' yards';
                break;
            case 'feet' :
                $this->content = number_format(round($number / 12)) . "'";
                break;
            case 'inches' :
                $feet = floor($number / 12);
                
                $inches = $number - $feet * 12;
                $inches = round($inches);
                
                if ($inches == 12) {
                    $feet++;
                    $inches = 0;
                }
                
                $this->content = '';
                $this->content .= number_format($feet) . "'";
                if (isset($inches) && $inches > 0) {
                    $this->content .= " {$inches}\"";
                }
                break;
        }
    }

}