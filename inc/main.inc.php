<?php 
class Main{
//get all users from database where user_id not = your id
 public function users($user_id){
 global $pdo;
 $query = $pdo->prepare("SELECT * FROM `myusers` U LEFT JOIN `follow` F on `f`.`receiver` = `U`.`user_id` AND CASE WHEN `F`.`sender` = ? THEN `F`.`receiver` = `U`.`user_id` END where `U`.`user_id` != ?");
 $query->bindValue(1,$user_id);
 $query->bindValue(2,$user_id);
  $query->execute();
 return $query->fetchAll(PDO::FETCH_ASSOC);
 }
 
//this is our follow method
 public function follow($user_id,$follow_id){
 global $pdo;
 //insert into follow where user_id = you and follow_id is = follower
 $query = $pdo->prepare("INSERT INTO `follow` (`sender`, `receiver`) VALUES (?, ?) ");
 //bind $user_id
 $query->bindValue(1,$user_id);
 //bind $follow_id
 $query->bindValue(2,$follow_id);
 //run query
 $query->execute();
 //add 1+ to follower profile
 $this->addNum($follow_id);

 }
 

 public function unFollow($user_id,$follow_id){
 global $pdo;
 //delete user_id and follow_id from follow 
 $query = $pdo->prepare("DELETE FROM `follow` WHERE `sender` = ? and `receiver` = ?");
 //bind user_id
 $query->bindValue(1,$user_id);
 //bind follow_id
 $query->bindValue(2,$follow_id);
  //run query
  $query->execute();
  //add -1 to follower_count
  $this->removeNum($follow_id);

 }

 public function addNum($follow_id){
 global $pdo;
 //add 1 more num to follow_counter
 $query = $pdo->prepare("UPDATE `myusers` SET `followers_count` = `followers_count` +1 WHERE `user_id` = ? ");
 //bind follow_id
 $query->bindValue(1,$follow_id);
 //run query
 $query->execute();
 }

 public function removeNum($follow_id){
 global $pdo;
 //remove 1 num from follow_counter
 $query = $pdo->prepare("UPDATE `myusers` SET `followers_count` = `followers_count` -1 WHERE `user_id` = ? ");
 //bind follow_id
 $query->bindValue(1,$follow_id);
 //run query
 $query->execute();
 }


}