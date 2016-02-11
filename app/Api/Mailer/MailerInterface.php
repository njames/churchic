<?php
/**
 * @author nigeljames
 * @date   11/02/16 7:53 PM
 */

namespace Cic\Api\Mailer;


/**
 * Interface Mailer
 * @package Cic\Api
 */
interface MailerInterface {

    /**
     * @return mixed
     */
    public function connect($clientId);

    /**
     * @return mixed
     */
    public function getLists();

    /**
     * @param $ListId
     * @return mixed
     */
    public function getListMembers($ListId);

    /**
     * @param $ListId
     * @param $Emails
     * @return mixed
     */
    public function batchSubscribe($ListId, $Emails);

    /**
     * @param $ListId
     * @param $Emails
     * @return mixed
     */
    public function batchUnsubscribe($ListId, $Emails);

}