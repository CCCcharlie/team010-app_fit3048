<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 * @property \Authentication\Controller\Component\AuthenticationComponent Authentication
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        // Load component from Authentication plugin
        $this->loadComponent('Authentication.Authentication');
    }

    /**
     * beforeRender override in AppController
     *
     * Use this function override in AppController to apply variables to all child views
     *
     * @return void
     */
    public function beforeRender(EventInterface $event)
    {
        parent::beforeRender($event);

        // Load global keys from ContentBlocks
//        $globalContentBlocks = $this
//            ->fetchTable('ContentBlocks')
//            ->find('list', [
//                'keyField' => 'hint',
//                'valueField' => 'content_value'
//            ])
//            ->where(['parent' => 'global'])  // Limit the search to home page only by the parent field
//            ->toArray();
//
//        $this->set(compact('globalContentBlocks'));
//    }
    }

    /**
     * Generate ID method
     *
     * @param string $identifier Identifier for current table [ex: STF, CUS, etc]
     * @param string $importantAttribute1 First important attribute used in making ID [ex: f_name = bryan]
     * @param string $importantAttribute2 Second important attribute used in making ID [ex: f_name = bryan]
     *
     * @return string $formattedID Returns the uniquely generated Id [ex: STF-BRYBRA-123-456-789]
     */
    public function generateId(string $identifier, string $importantAttribute1, string $importantAttribute2): string
    {
        //////////////////////////////////////////
        // Artificially craft a unique id here //
        //////////////////////////////////////////

        //In order to create 10 random unique numbers, we use uniqid() as seed (which seeds in microseconds)
        // and CRC32 hash to add more variety.
        // To generate the 10 random numbers, we use function mt_rand()
        $seed = uniqid();
        mt_srand(crc32($seed)); // Using CRC32 hash of the uniqid as the seed

//            debug(mt_rand());
//            debug($customer);
//            debug($customer->id);

        //Get first three letters of names
        $threeCharAttribute1 = substr($importantAttribute1, 0, 3);
        $threeCharAttribute2 = substr($importantAttribute2, 0, 3);

        //Convert the 10 random numbers into string using strval
        $randNumStrings = strval(mt_rand());

        //Format the 10 random numbers to be like 123-456-789 via substr
        $formattedRandNumStrings = substr($randNumStrings, 0, 3) . '-' . substr($randNumStrings, 3, 3) . '-' . substr($randNumStrings, 6);

        $formattedId = $identifier . '-' . $threeCharAttribute1 . $threeCharAttribute2 . '-' . $formattedRandNumStrings;
//            debug($formattedId);
//            exit;

        return $formattedId;

        ////////////////////////////////////////////////
        // End of Artificially craft a unique id here //
        ////////////////////////////////////////////////
    }
}
