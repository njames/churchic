<?php  namespace sc\cic\Util;

use \Maatwebsite\Excel\Files\ExcelFile;
use Input;

/**
 * @author nigeljames
 * @date   15/10/15 7:36 AM
 */
class PhotoListImport extends ExcelFile {


    public function getFile() {
        // Import a user provided file
        $file = Input::file('spreadsheet');
        $filename = $this->importFile($file);

            // Return it's location
        return $filename;
    }


    private function importFile($file) {

        $filename = storage_path('uploads/csv/') . time() . $file->getClientOriginalName();

        $file->move( $filename );

        return $filename;
    }

}
