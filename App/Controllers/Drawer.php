<?php
class Drawer{
    public function __construct($items) {
       
      $items=json_decode($items);
      foreach ($items as $item){
          $this->draw($item);
      }
      
    }
    public function draw($item){
        
        echo "<div class='item ng-binding ng-scope'>".$item->label."<a ng-click='removeElem(item.id)'>x</a>
            </div>";
            
        
    }
}

