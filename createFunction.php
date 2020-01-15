<?php

function create(array $data,string $table,PDO $pdo, $debug = null)
{
  if(isset($debug)){

    echo $data;
    echo var_dump($data);

  }

  $STH = $pdo->prepare("DESCRIBE $table");
  $STH->execute();
  $table_fields = $STH->fetchAll(PDO::FETCH_COLUMN);

  $filterOutKeys = array_diff( array_keys($data), array_values($table_fields ));
  $filterOutKeys = array_merge($filterOutKeys, ['id']);

  if(isset($debug)){

    print_r($filterOutKeys);

  }

  $filteredArr = array_diff_key( $data, array_flip( $filterOutKeys ) );
    
    $columns=array_keys($filteredArr);
    $values=array_values($filteredArr);
  try{

    $str="INSERT INTO `{$table}` (".implode(',',$columns).") VALUES ('" . implode("', '", $values) . "' )";

    if(isset($debug)){

      echo $str;

    }

    $stmt=$pdo->prepare($str);  
    $stmt->execute();
    return true;
  }  catch(PDOException $err){
    echo $err->getMessage();
  }
    if(isset($debug)){

      printf("Error: %s\n", $stmt->error);
      return false;

    }
}


function update (array $data,string $table,int $id,PDO $pdo,  $debug = null)
{
      if(isset($debug)){

        echo var_dump($data);

      }

      $STH = $pdo->prepare("DESCRIBE $table");
      $STH->execute();
       $table_fields = $STH->fetchAll(PDO::FETCH_COLUMN);
       //return $data;
       //array_values($table_fields);
        $filterOutKeys = array_diff( array_keys($data), array_values($table_fields ));
         $filterOutKeys = array_merge($filterOutKeys, ['id']);
          //array_flip( $filterOutKeys );
    if(isset($debug)){

     print_r($filterOutKeys);

    }

      $filteredArr = array_diff_key( $data, array_flip( $filterOutKeys ) );
        
      $setPart = array();
      $bindings = array();
    
      foreach ($filteredArr as $key => $value)
      {
        //return  $key;
         $setPart[] = "{$key} = :{$key}";
        $bindings[":{$key}"] = $value;
      }
      
    
      $bindings[":id"] = $id;
      try{
      $sql = "UPDATE {$table} SET ".implode(', ', $setPart)." WHERE ID = :id";

      if(isset($debug)){
        
        echo $sql;

      } 

      $stmt=$pdo->prepare($sql);
        
      $stmt->execute($bindings);
      if(isset($debug)){

          print_r($bindings);

      }
      
      return true;
      }  catch(PDOException $err){
        echo $err->getMessage();
        return false;
      }
      return false;
}

