<?php 
include("./models/User.php");
/* Para el uso de UserController en la parte de las vistas:

$pdo = getDbConnection();
$userController = new UserController($pdo);
$users = $userController->getAllUsers();

*/
class UserController {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // Función que devuelve todos los datos de todos los usuarios de la base de datos -> FUNCIONA
    function getAllUsers(){
        try{
            $stmt = $this->pdo->query('SELECT id, name, email, role, registration_date FROM users');  
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (ErrorException $err){
            echo($err);
            throw new Exception("Error al obtener los datos de todos los usuarios.");
        }
    }   

    /* Función que se le pasa de entrada un objeto de tipo User, y que crea en la base de datos una nueva 
    entrada en la tabla de users -> FUNCIONA
    
        $user = new User();
        $user->setName("José Ramon Perez Garcia");
        $user->setEmail("jmperezgarcia@hotmail.com");
        $user->setRole("Visintante");
        $userController->addUser($user);
    */ 
    function addUser(User $user){
        try{
            $date = date("Y-m-d G:i:s");
            $stmt = $this->pdo->prepare('INSERT INTO users (name, email, role, registration_date) VALUES (:name, :email, :role, :registration_date)');
            $stmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':role', $user->getRole(), PDO::PARAM_STR);
            $stmt->bindValue(':registration_date', $date, PDO::PARAM_STR);
            $stmt->execute();
            return;
        }catch (ErrorException $err){
            echo($err);
            throw new Exception("Error al crear al usuario.");
        }
    }

    // Funcion para eliminar un usuario, pasando como entrada el id de este mismo -> FUNCIONA
    function deleteUser(int $id){
        try{
            $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return;
        }catch (ErrorException $err){
            echo($err);
            throw new Exception("Error al eliminar al usuario.");
        }
    }

    /*Función para editar a un usuario, a partir de un objeto tipo User. Primero comprueba con la bdd 
    si hay algo nuevo con respecto a los datos del usuario, si no es asi no se edita el usuario. -> FUNCIONA
    
        $user = new User();
        $user->setId(7);
        $user->setName("José Ramon Perez Garcia");
        $user->setEmail("jmperezgarcia@hotmail.com");
        $user->setRole("Visitor");
        $userController->editUser($user);
    
    */
    function editUser(User $user){
        try{
            $stmt = $this->pdo->prepare('UPDATE users SET name = :name, email = :email, role =:role WHERE id = :id');
            $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':role', $user->getRole(), PDO::PARAM_STR);
            $stmt->execute();
            return;
        }catch (ErrorException $err){
            echo($err);
            throw new Exception("Error al editar al usuario.");
        }

    }

    //Funcion que devuelve la información de un usuario pasando como entrada un id -> FUNCIONA
    function getUserInfo(int $id){
        try{
            $stmt = $this->pdo->prepare('SELECT id, name, email, role, registration_date FROM users WHERE id = :id');
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (ErrorException $err){
            echo($err);
            throw new Exception("Error al obtener los datos del usuario.");
        }
    }

}
?>