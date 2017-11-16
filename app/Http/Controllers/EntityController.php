<?php

namespace App\Http\Controllers;

use App\EndpointModel;
use App\Entity;
use App\Enums\EnumClassCode;
use App\Enums\EnumPhoneNumberType;
use App\Ticket;
use App\User;
use App\EntityContact;
use App\EntityName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class EntityController extends Controller
{

    /**
     *
     * getEntitiesView
     *
     * Returns Entities view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEntitiesView()
    {
        return view('measure.accounts', ['viewname' => 'Accounts']);
    }

    /**
     *
     * getEntities
     *
     * returns entity objects
     *
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEntities($options)
    {

        $options = json_decode($options);

        /**
         * @var User $user
         */
        $user = $this->validateObject($options);

        $accounts = $user->getTeamMembersEntities();

        $accounts_array = array();

        foreach ($accounts as $a) {
            $account = new \stdClass();
            $account->name = $a->contact->name->name;
            $account->id = $a->id;
            $accounts_array[] = $account;
        }



        return response()->json($accounts_array);
    }


    /**
     *
     * getEntityView
     *
     * returns entity view
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEntityView($id)
    {
        $entity = Entity::getObjectById($id);
        return view('measure.account', ['viewname' => 'account', 'entity' => $entity]);
    }

    /**
     *
     * getEntity
     *
     * returns Entity Data
     * @var Entity $entity
     * @param $options
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEntity($options)
    {
        $options = json_decode($options);

        /**
         * @var Entity $entity
         */
        $entity = $this->validateObject($options);

        $entity_obj = new \stdClass();

        $entity_obj->name = $entity->contact->name->name;

        $entity_obj->contact = $entity->contact;

        $sites = $entity->sites;

        $entity_obj->sites = array();

        foreach ($sites as $s) {

            $site = new \stdClass();

            $l = $s->location;

            $site->address = $l->address;
            $site->city = $l->city;
            $site->state = $l->state;
            $site->zip = $l->zipcode;
            $site->name = $s->name->name;


            if ($s->email->address !== "") {
                $site->email = $s->email->address;
            } else {
                $site->email = "Email is not listed.";
            }


            if ($s->phonenumber->number !== null) {
                $site->number = $s->phonenumber->number;
            } else {
                $site->number = "Number is not listed.";
            }

            $entity_obj->sites[] = $site;
        }

        $entity_obj->personnel = array();

        $count = 0;

        if (count($entity->persons) > 0) {
            foreach ($entity->persons as $p) {

                $person = new \stdClass();

                $person->fullname = $p->name->first_name . ' ' . $p->name->last_name;

                if ($p->phonenumber !== null) {
                    $person->number = $p->phonenumber->rawnumber;
                    $person->phonetype = EnumPhoneNumberType::getValueByKey($p->phonenumber->phone_type);
                } else {
                    $person->number = "N/A";
                    $person->phonetype = "N/A";
                }


                $person->email = $p->email->address;

                $person->address = $p->location->address;

                $person->city = $p->location->city;
                $person->state = $p->location->state;
                $person->zip = $p->location->zipcode;

                // TODO update badges when we start pulling in real data. //

                if ($count === 0) {

                    $person->badges = array(
                        'IDSuite',
                        'Manual'
                    );

                } else {
                    $person->badges = array(
                        'NetSuite',
                        'Trust',
                        'IDSuite'
                    );
                }
                $entity_obj->personnel[] = $person;


                $count++;
            }
        }

        $entity_obj->notes = array();

        foreach ($entity->notes->sortByDesc('created_at') as $n) {

            $note = new \stdClass();

            $note->text = $n->text;
            $note->created = $n->created_at;

            $entity_obj->notes[] = $note;
        }

        $entity_obj->tickets = (new Ticket)->where('entity_id', '=', $entity->id)->paginate(15);


        return response()->json(['entity' => $entity_obj]);
    }
}
