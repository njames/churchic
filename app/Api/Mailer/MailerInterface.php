<?php
/**
 * @author nigeljames
 * @date   11/02/16 7:53 PM
 */

namespace ChurchIC\Api\Mailer;


/**
 * Interface Mailer
 * @package ChurchIC\Api
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

    /**
     * @param $ListId
     * @param $Emails
     * @return mixed
     */
    public function batchUpdate($ListId, $Emails);

    public function checkBatch($batch);

    /**
     * @param $listId
     * @param $email
     */
    public function subscribe($listId, $email);

    /**
     * @param $listId
     * @param $email
     */
    public function unSubscribe($listId, $email);

    /**
     * @param $listId
     * @param $email
     */
    public function update($listId, $email);

}