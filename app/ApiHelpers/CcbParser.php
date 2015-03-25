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

      $id = Hashids::encode((int)$individual->attributes());

      $dbIndividual = Individual::find($id);

      if(!$dbIndividual){
        $dbIndividual = new Individual;
      }

      $dbIndividual->id = $id;
      $dbIndividual->client_id = (string)$client;
//      $dbIndividual->individual_id = $individual->attributes();
      $dbIndividual->individual_id = (string)$individual['id'];


      $dbIndividual->first_name  = (string)$individual->first_name ;
      $dbIndividual->last_name = (string)$individual->last_name ;
      $dbIndividual->legal_first_name = (string)$individual->legal_first_name;

      $dbIndividual->sync_id = ( (int) $individual->sync_id != 0 ? (int) $individual->sync_id: null); //why?
      $dbIndividual->other_id = (int)$individual->other_id;
      $dbIndividual->salutation = (string)$individual->salutation;
      $dbIndividual->campus_id = (int)$individual->campus->attributes();
      $dbIndividual->campus = (string)$individual->campus;
      $dbIndividual->family_id = $individual->family_id->attributes();
      $dbIndividual->family_position = (string)$individual->family_position;
      $dbIndividual->family_position = substr( (string)$individual->family_position, 0, 1);
      $dbIndividual->birthday = $individual->birthday; // may need to use carbon
//      $dbIndividual->anniversary = $individual->anniversary;
//      $dbIndividual->deceased = $individual->deceased;
//      $dbIndividual->membership_date = $individual->membership_date;
//      $dbIndividual->membership_end = $individual->membership_end;
//      $dbIndividual->membership_type_id = $individual->membership_type->attributes();
//      $dbIndividual->receive_email_from_church = $individual->receive_email_from_church;
//      $dbIndividual->giving_number = $individual->giving_number;
//      $dbIndividual->email = $individual->email;


      // @todo complete this class - need other fields

      $dbIndividual->save();
    }

  }


}