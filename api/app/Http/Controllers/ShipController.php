<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShipOrder;
use App\Models\ItemOrder;
use Doctrine\Common\Persistence\ManagerRegistry;
use File;
use EntityManager;
use Exception;

class ShipController extends Controller
{
    protected $entityManager;
    
    public function __construct(ManagerRegistry $em) {
        $this->entityManager = $em;
    }
    
    public function get(Request $request) {        
        return response()->json(['success' => true, 
                                 'data' => $this->entityManager->getRepository('App\Models\ShipOrder')->findAll()]);
    }
    
    public function delete($id) {
        $code = 200;
        $message = 'Operation succeeded';
        
        try {
            $shipOrder = $this->entityManager->getRepository('App\Models\ShipOrder')->find($id);
        
            if(!$shipOrder) {
                throw new Exception('Not found ship order');
            }

            EntityManager::remove($shipOrder);
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
            $shipOrders = simplexml_load_string(File::get($request->file('file')->path()));

            if($shipOrders) {
                foreach($shipOrders as $shipOrder) {

                    $shipOrderModel = new ShipOrder();
                    $shipOrderModel->setId((int)$shipOrder->orderid);
                    $shipOrderModel->setPersonOrder((int)$shipOrder->orderperson);
                    $shipOrderModel->setName($shipOrder->shipto->name);
                    $shipOrderModel->setAddress($shipOrder->shipto->address);
                    $shipOrderModel->setCity($shipOrder->shipto->city);
                    $shipOrderModel->setCountry($shipOrder->shipto->country);

                    foreach((array)$shipOrder->items as $item) {
                        if(!is_array($item)) {
                            $item = array($item);
                        }

                        foreach($item as $obj) {
                            $itemOrder = new ItemOrder();
                            $itemOrder->setTitle($obj->title);
                            $itemOrder->setNote($obj->note);
                            $itemOrder->setQuantity((int)$obj->quantity);
                            $itemOrder->setPrice((float)$obj->price);

                            $shipOrderModel->addItemOrder($itemOrder);
                        }
                    }


                    EntityManager::persist($shipOrderModel);
                    EntityManager::flush();

                }
            } else {
                throw new Exception('Invalid file');
            }
            
        } catch(Exception $e) {
            $message = $e->getMessage();
            $code = 400;
        } 
        return response()->json(["message" => $message],$code);
    }
}
