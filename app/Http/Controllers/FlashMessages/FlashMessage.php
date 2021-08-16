<?php

namespace FlashMessage{

    interface Message{
        public function message($request, $type, $msg);
    }
    

    class Filter{
        private $type = "success";

        public function filter($type){
            return $type == $this->type;
        }
    }

    
    class Failed implements Message{
        
        public function message($request, $type, $msg)
        {
            $request->session()->flash($type, $msg);
        }
    }
    
    
    class Success implements Message{
    
        public function message($request, $type, $msg)
        {
            $request->session()->flash($type, $msg);
        }
    }
    
    
    class Manage{
    
        private $type;
        private $msg;
        private $request;

        public function __construct($request, $type, $msg)
        {
            $this->type = $type;
            $this->msg = $msg;
            $this->request = $request;

            // Filter type and select suitable class tu run
            $this->filter();
        }       

        public function filter()
        {
            // if ($this->message->filter($type)){
            //     $this->message->message($request, $type, $msg);
            // }

            $obj1 = new Success;
            $obj2 = new Failed;

            if ($this->type == "failed"){
                $obj2->message($this->request, $this->type, $this->msg);
            }
            elseif ($this->type == "success"){
                $obj1->message($this->request, $this->type, $this->msg);
            }
        }
    }
}