<?php
/**
*   @author Matthew O'Neill / C11354316
*/
require_once 'baseView.php';
class xmlView extends baseView{

    //I stole this from here: http://lab.artlung.com/xml-encode/
    private function xml_encode($mixed,$domElement=null,$DOMDocument=null){
        if(is_null($DOMDocument)){
            $DOMDocument=new DOMDocument;
            $DOMDocument->formatOutput=true;
            $this->xml_encode($mixed,$DOMDocument,$DOMDocument);
            echo $DOMDocument->saveXML();
        }
        else{
            if(is_array($mixed)){
                foreach($mixed as $index=>$mixedElement){
                    if(is_int($index)){
                        if($index==0){
                            $node=$domElement;
                        }
                        else{
                            $node=$DOMDocument->createElement($domElement->tagName);
                            $domElement->parentNode->appendChild($node);
                        }
                    }
                    else{
                        $plural=$DOMDocument->createElement($index);
                        $domElement->appendChild($plural);
                        $node=$plural;
                        if(rtrim($index,'s')!==$index){
                            $singular=$DOMDocument->createElement(rtrim($index,'s'));
                            $plural->appendChild($singular);
                            $node=$singular;
                        }
                    }
                    $this->xml_encode($mixedElement,$node,$DOMDocument);
                }
            }
            else{
                $domElement->appendChild($DOMDocument->createTextNode($mixed));
            }
        }
    }

    public function output(){
        $xmlResponse = $this->xml_encode($this->model->apiResponse);
        $this->slimApp->response->write($xmlResponse);
    }
}
?>
