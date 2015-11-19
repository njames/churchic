<?php  namespace sc\cic\Util;

use \Maatwebsite\Excel\Files\ExcelFile;
use Input;

/**
 * @author nigeljames
 * @date   15/10/15 7:36 AM
 */
class PhotoListImport extends ExcelFile {

    protected $delimiter  = ',';
    protected $enclosure  = '"';
//    protected $lineEnding = '\r\n';

    public function getFile() {
        // Import a user provided file

        $file = Input::file('spreadsheet');

        $filename =  time() . '_' . $file->getClientOriginalName();

        $file = $file->move('uploads/csv/', $filename);

        // Return it's location
        return $file->getPathname();
    }


    public function processFile($filename) {


    }

}

