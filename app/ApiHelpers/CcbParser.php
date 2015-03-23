<?php  namespace sc\cic\ApiHelpers;

use sc\cic\Models\Individual;
use Vinkla\Hashids\Facades\Hashids;

/**
 * @author nigeljames
 * @date   23/03/15 10:59 PM
 */
class CcbParser {

  public static function parseIndividuals($sxe, $client){

    foreach( $sxe->response->individuals->individual as $individual ) {

//      dd($individual);

      $id = Hashids::encode($individual->attributes());

      $dbIndividual = Individual::find($id);

      if(!$dbIndividual){
        $dbIndividual = new Individual;
      }

      $dbIndividual->id = $id;
      $dbIndividual->client_id = $client;
      $dbIndividual->individual_id = $individual->attributes();


      $dbIndividual->first_name  = $individual->first_name ;
      $dbIndividual->last_name = $individual->last_name ;
      $dbIndividual->legal_first_name = $individual->legal_first_name;

      $dbIndividual->sync_id = ( (int) $individual->sync_id != 0 ? (int) $individual->sync_id: null);
      $dbIndividual->other_id = $individual->other_id;
      $dbIndividual->salutation = $individual->salutation;
      $dbIndividual->campus_id = $individual->campus->attributes();
      $dbIndividual->campus = $individual->campus;
      // @todo complete this class - need other fields

      $dbIndividual->save();
    }

  }


}