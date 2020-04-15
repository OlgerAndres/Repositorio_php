<?php

class Articulos extends Entity
{


    protected function init(): void {

        $query = <<<SQL
CREATE TABLE IF NOT EXISTS articulos (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(255) NOT NULL,
breve_description VARCHAR(225) NOT NULL,
descripcion VARCHAR(255) NOT NULL
)
SQL;

        if(!$this->database->query($query)) {
            throw new \Exception($this->database->error);
        }
    }
    
    public function create(): string {
    $query= 'INSERT INTO articulos(nombre,breve_descripcion,descripcion) VALUES (?, ?, ?)';
    $stmt = $this->database->prepare($query);
        $stmt->bind_param('ss', $this->request['nombre'], $this->request['breve_description'], $this->request['descripcion']);

        $stmt->execute();
        $stmt->close();

        return $this->database->insert_id;

    }

    public function findAll(): array {
        $query = 'SELECT id, nombre, breve_descripcion,descripcion FROM articulos';
        $result = $this->database->query($query);

        $records = [];
        while ($item = $result->fetch_object()) {
            $records[] = $item;
        }

        return $records;
    }


    public function findById(): object {
        $query = "SELECT id, nombre, breve_description,descripcion FROM articulos WHERE id = " . $this->request['id'];
        $result = $this->database->query($query);

        return $result->fetch_object();
    }

 
    public function deleteById($id): bool {
        return $this->database->query("DELETE FROM articulos WHERE id={$id}");
    }

 
    public function updateItem() {
        if(!empty($this->request['nombre']) && !empty($this->request['breve_description']) && !empty($this->request['description'])) {
          $query = "UPDATE articulos SET nombre = '{$this->request['nombre']}', breve_description = '{$this->request['breve_description']}' ,descripcion = '{$this->request['descripcion']}' WHERE id = {$this->request['id']}";
          $this->database->query($query);

          return $this->database->affected_rows;
        }
        return FALSE;
    }

    public function __destruct()
    {
        $this->database->close();
    }



}

    