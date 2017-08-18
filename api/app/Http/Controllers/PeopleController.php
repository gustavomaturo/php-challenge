<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Person;
use App\Models\Phone;
use EntityManager;
use Doctrine\Common\Persistence\ManagerRegistry;
use Exception;

class PeopleController extends Controller
{
    protected $entityManager;
    
    public function __construct(ManagerRegistry $em) {
        $this->entityManager = $em;
    }
    
    public function get(Request $request) {        
        return response()->json(['success' => true, 
                                 'data' => $this->entityManager->getRepository('App\Models\Person')->findAll()]);
    }
    
    public function delete($id) {
        $code = 200;
        $message = 'Operation succeeded';
        
        try {
            $person = $this->entityManager->getRepository('App\Models\Person')->find($id);
        
            if(!$person) {
                throw new Exception('Not found person');
            }

            EntityManager::remove($person);
            EntityManager::flush();
        
        } catch(Exception $e) {
            $code = 400;
            $message = $e->getMessage();
        }
        
        return response()->json(["message" => $message], $code);
    }
    
    public function create(Request $request) {
        $message = 'Operation succeeded';
        $code = 200;

        try{
            libxml_use_internal_errors(true); 
            $people = simplexml_load_string(File::get($request->file('file')->path()));
            if($people) {
                $this->entityManager->getConnection()->beginTransaction();
                foreach($people as $person) {

                    $personModel = new Person((int)$person->personid, $person->personname);

                    foreach((array)$person->phones->phone as $number) {
                        $personModel->addPhone(new Phone($number));
                    }
                    
                    EntityManager::persist($personModel);
                    EntityManager::flush();
                }
                $this->entityManager->getConnection()->commit();
            } else {
                throw new Exception('Invalid file');
            }
        
        } catch(\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
            $message = "Register already exists";
            $this->entityManager->getConnection()->rollBack();
            $code = 400;
        }  catch(\Doctrine\DBAL\DBALException $e) {
            $message = $e->getMessage();
            $code = 500;
        }  catch(Exception $e) {
            $message = $e->getMessage();
            $code = 400;
        }
        return response()->json(["message" => $message], $code);
    }
}
