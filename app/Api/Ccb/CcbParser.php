<?php

namespace ChurchIC\Api\Ccb;

use Carbon\Carbon;
use ChurchIC\Models\Individual;
use Vinkla\Hashids\Facades\Hashids;

/**
 * @author nigeljames
 * @date   23/03/15 10:59 PM
 */
class CcbParser
{
    const DB_DATE_FORMAT = 'Y-m-d';

    public static function parseIndividuals($sxe, $client)
    {
        foreach ($sxe->response->individuals->individual as $individual) {

      // grab individual id - we need it for a few things
      $individualId = (int) $individual->attributes();

            $id = Hashids::encode($individualId);

            $dbIndividual = Individual::find($id);

            if (!$dbIndividual) {
                $dbIndividual = new Individual();
            }

            $dbIndividual->id = $id;
            $dbIndividual->client_id = $client;
            $dbIndividual->individual_id = $individualId;

            $dbIndividual->first_name = $individual->first_name;
            $dbIndividual->last_name = $individual->last_name;
            $dbIndividual->legal_first_name = $individual->legal_first_name;

            $dbIndividual->sync_id = ((int) $individual->sync_id ?: null);

            $dbIndividual->other_id = (int) $individual->other_id;
            $dbIndividual->salutation = $individual->salutation;
            $dbIndividual->campus_id = (int) $individual->campus->attributes();
            $dbIndividual->campus = $individual->campus;
            $dbIndividual->family_id = (int) $individual->family->attributes();
            $dbIndividual->family_position = substr((string) $individual->family_position, 0, 1);

      // dates
      $dbIndividual->birthday = self::parseDate($individual->birthday) ?: null;
            $dbIndividual->anniversary = self::parseDate($individual->anniversary) ?: null;
            $dbIndividual->deceased = self::parseDate($individual->deceased) ?: null;
            $dbIndividual->membership_date = self::parseDate($individual->membership_date) ?: null;
            $dbIndividual->membership_end = self::parseDate($individual->membership_end) ?: null;

            $dbIndividual->membership_type_id = (int) $individual->membership_type->attributes();

            $dbIndividual->receive_email_from_church = $individual->receive_email_from_church;
            $dbIndividual->giving_number = (int) $individual->giving_number;
            $dbIndividual->email = $individual->email;

      // addresses


      // custom fields
      $dbIndividual->udf_text_1 = $individual->udf_text_1;
            $dbIndividual->udf_text_2 = $individual->udf_text_2;
            $dbIndividual->udf_text_3 = $individual->udf_text_3;
            $dbIndividual->udf_text_4 = $individual->udf_text_4;
            $dbIndividual->udf_text_5 = $individual->udf_text_5;
            $dbIndividual->udf_text_6 = $individual->udf_text_6;
            $dbIndividual->udf_text_7 = $individual->udf_text_7;
            $dbIndividual->udf_text_8 = $individual->udf_text_8;
            $dbIndividual->udf_text_9 = $individual->udf_text_9;
            $dbIndividual->udf_text_10 = $individual->udf_text_10;
            $dbIndividual->udf_text_11 = $individual->udf_text_11;
            $dbIndividual->udf_text_12 = $individual->udf_text_12;

            $dbIndividual->udf_date_1 = self::parseDate($individual->udf_date_1) ?: null;
            $dbIndividual->udf_date_2 = self::parseDate($individual->udf_date_2) ?: null;
            $dbIndividual->udf_date_3 = self::parseDate($individual->udf_date_3) ?: null;
            $dbIndividual->udf_date_4 = self::parseDate($individual->udf_date_4) ?: null;
            $dbIndividual->udf_date_5 = self::parseDate($individual->udf_date_5) ?: null;
            $dbIndividual->udf_date_6 = self::parseDate($individual->udf_date_6) ?: null;

      // modified by - not sure we need to update this


      // @todo complete this class - need other fields

      $dbIndividual->save();
        }
    }

    public static function parseDate($dateAsString)
    {
        $returnDate = null;

        if (!is_null($dateAsString)) {
            try {
                $returnDate = Carbon::createFromFormat(self::DB_DATE_FORMAT, $dateAsString)->startOfDay()->format(self::DB_DATE_FORMAT);
            } catch (\Exception $e) {
            }
        }
//        \Log::info("Date $returnDate");

        return $returnDate;
    }
}
