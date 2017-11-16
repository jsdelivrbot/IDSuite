<?php

namespace App;


use Illuminate\Support\Collection;

class helpers
{

    /**
     *
     * getTeamMembersHelper
     *
     * recursively return all team members nodes given the manager
     *
     * @param User $user
     * @param Collection|null $all_team_members
     * @param User $head
     * @param int $total
     * @return Collection
     */
    public static function getTeamMembersHelper(User $user, Collection $all_team_members = null, User $head, $total = 0)
    {


//        dump('********Start*********');
//        dump('User : ' . $user->getFullName());


        $team_members = $user->where('manager_id', '=', $user->id)->get();

        if($all_team_members === null ){
            if($team_members->isEmpty()){
                $all_team_members = collect();
                return $all_team_members->push($user);
            } else {
                $all_team_members = collect();
            }
//            dump('all_team_members is null so we created a colleciton');
        } else {

            $unprocessed_members = false;

            $count = 0;
            foreach ($team_members as $member){
                if(!$all_team_members->contains($member)){
                    $unprocessed_members = true;
                    break;
                }
                $count++;
            }

//            dump('Team Members Processed is ' . $count . ' Out of ' . $team_members->count());

            if ($unprocessed_members === false && $user->email === $head->email) {
                return $all_team_members;
            }
        }

//        dump('team members count : ' . $team_members->count());

        if ($team_members->count() === 0){

//            dump('team members where count === 0 : ' . $team_members);

            if(!$all_team_members->contains($user)){

//                dump('user being pushed to all team member: ' . $user);

                $all_team_members->push($user);

//                dump('all members where the user did not exist : ' .$all_team_members);

                return self::getTeamMembersHelper(User::getObjectById($user->manager_id), $all_team_members, $head, $total);

            } else {

//                dump('return all team members: ' . $all_team_members);

                return self::getTeamMembersHelper(User::getObjectById($user->manager_id), $all_team_members, $head, $total);
            }

        } else {

//            dump('team members : ' . $team_members->pluck('email'));

            $count = $team_members->count();

            $index = 0;

            foreach ($team_members as $member){

//                dump($user . "'s team members left to process is " . $count . ": " . $team_members->pluck('email')->slice($index, $team_members->count()));

                if($all_team_members->contains($member)){
                    $count--;
                    $index++;
                    continue;
                } else {
                    return self::getTeamMembersHelper(User::getObjectById($member->id), $all_team_members, $head, $total);
                }



            }

            /**
             * @var User $manager
             */
            $manager = User::getObjectById($user->manager_id);

            $all_team_members->push($user);

            if($manager === null){
                return $all_team_members;
            } else {
                return self::getTeamMembersHelper($manager, $all_team_members, $head, $total);
            }


        }


    }


}
