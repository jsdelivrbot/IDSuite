<?php

namespace App\Http\Controllers;

use App\EndpointModel;
use App\Entity;
use App\Enums\EnumPhoneNumberType;
use App\Ticket;
use App\User;
use App\EntityContact;
use App\EntityName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntityController extends Controller
{

    public $randomnumber;

    public function getEntitiesView()
    {
        return view('measure.accounts', ['viewname' => 'Accounts']);
    }

    public function getEntities($user_id)
    {
        $user = User::getObjectById($user_id);

        $accounts = $user->accounts;

        $accounts_array = array();

        foreach ($accounts as $a) {

            if (count($a->children) > 0) {

                foreach ($a->children as $child) {

                    if($child->user !== null) {

                        if ($user->id !== $child->user->id) {

                            $account = new \stdClass();
                            $account->name = $child->contact->name->name;
                            $account->id = $child->id;

                            $accounts_array[] = $account;
                        }
                    }
                }
            }

            $account  = new \stdClass();

            $account->name  = $a->contact->name->name;
            $account->id    = $a->id;

            $accounts_array[] = $account;
        }

        return response()->json($accounts_array);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $accounts = $user->accounts;

        $accounts_array = array();

        foreach ($accounts as $a) {

            if (count($a->children) > 0) {

                foreach ($a->children as $child) {

                    if($child->user !== null) {

                        if ($user->id !== $child->user->id) {

                            $account = new \stdClass();
                            $account->name = $child->contact->name->name;
                            $account->id = $child->id;

                            $accounts_array[] = $account;
                        }
                    }
                }
            }

            $account  = new \stdClass();

            $account->name  = $a->contact->name->name;
            $account->id    = $a->id;

            $accounts_array[] = $account;
        }

        return view('measure.accounts', ['accounts' => $accounts_array, 'viewname' => 'Accounts']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param String $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        session(['currentaccount' => $id]);
//
//        return $this->getEntity($id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
        //
    }

    public function getEntityView($id)
    {

        $entity = Entity::getObjectById($id);

        return view('measure.account', ['viewname' => 'account', 'entity' => $entity]);
    }

    /**
     * @param $id
     * @return string
     */
    public function getEntity($id)
    {
        $entity = Entity::getObjectById($id);

        $entity_obj = new \stdClass();

        $name = $entity->contact->name;
        $entity_obj->contact = $entity->contact;

        $sites = $entity->sites;

        $sites_array = array();

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

            $sites_array[] = $site;
        }

        $entity_obj->sites = $sites_array;

        $persons_array = array();

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
                $persons_array[] = $person;


                $count++;
            }
        }

        $entity_obj->personel = $persons_array;

        $notes_array = array();

        foreach ($entity->notes->sortByDesc('created_at') as $n) {

            $note = new \stdClass();

            $note->text = $n->text;
            $note->created = $n->created_at;

            $notes_array[] = $note;
        }

        $entity_obj->notes = $notes_array;

        $page_ticket = new Ticket;

        $page_tickets = $page_ticket->where('entity_id', '=', $entity->id)->paginate(15);

        $entity_obj->tickets = $page_tickets;

        return response()->json(['entity' => $entity_obj]);
    }
}
