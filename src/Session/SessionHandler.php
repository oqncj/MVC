<?php

namespace src\Session;
use src\DB\Database;

class SessionHandler implements \SessionHandlerInterface {

    public function open( $path, $name ) {
        return true;
    }

    public function close() {
        return true;
    }

    public function read( $id ) {
        $data = current(Database::getAll('select * from session where id = ?',[$id]));
        if ($data){
            $payload = $data->payload;
        }else{
            Database::exec('insert into session(id) values(?)',[$id]);
        }
        return $payload ?? '';
    }

    public function destroy( $id ) {
        return Database::exec('delete from session where id = ?',[$id]);
    }

    public function gc( $max_lifetime ) {
        if($session = Database::getAll('select * from session ')){
            foreach ($session as $sessions){
                $timestamp = strtotime($sessions->created_at);
                if (time() - $timestamp > $max_lifetime){
                    $this->destroy($sessions->id);
                }
            }
            return true;
        }
        return false;

    }

    public function write( $id, $payload ) {
        return Database::exec('update session set payload = ? where id = ?',[$id,$payload]);
    }
}