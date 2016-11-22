<?php

namespace sc\cic\ApiHelpers;

use GuzzleHttp\Client;

/**
 * @author nigeljames
 * @date   22/03/15 4:16 PM
 */
class CcbApi
{
    const API_URI = 'api.php';

    protected $client;

    public function __construct($client_id, $username, $password)
    {
        $client = new Client([
      'base_url' => "https://$client_id.ccbchurch.com/",
      'defaults' => ['auth' => [$username, $password]],
    ]);

        $this->client = $client;
    }

    public function groupProfiles($modifiedSince)
    {
        $service = 'group_profiles';

        $url = self::API_URI."?srv=$service&modified_since=$modifiedSince";

        return $this->client->get($url);
    }

    public function groupProfileByGroupId($groupId)
    {
        $service = 'group_profile_from_id';

        $url = self::API_URI."?srv=$service&id=$groupId";

        return $this->client->get($url);
    }

    public function groupParticipantsByGroupId($groupId)
    {
        $service = 'group_participants';

        $url = self::API_URI."?srv=$service&id=$groupId";

        return $this->client->get($url);
    }

    public function individualProfiles($modifiedSince)
    {
        $service = 'individual_profiles';

        $url = self::API_URI."?srv=$service&modified_since=$modifiedSince";

        return $this->client->get($url);
    }

    public function individualProfileFromId($individualId)
    {
        $service = 'individual_profile_from_id';

        $url = self::API_URI."?srv=$service&modified_since=$individualId";

        return $this->client->get($url);
    }

    public function individualSearch($searchParamaters)
    {
        $service = 'individual_search';

        $url = self::API_URI."?srv=$service";

        foreach ($searchParamaters as $key => $value) {
            $url .= '&'.$key.'='.$value;
        }

        return $this->client->get($url);
    }

    public function individualUpdateType($individualId, $type)
    {
        $service = 'update_individual';

        $url = self::API_URI."?srv=$service&individual_id=$individualId";

        return $this->client->post($url, [
            'body' => [
                'membership_type_id' => $type
            ] 
        ]);

    }
  //
}
