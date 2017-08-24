<?php
require 'app\userService.php';
if ($argc < 2 || in_array($argv[1], array('help', '--help', '-help', '-h', '-?'))) {
?>
<command> <arguments>
List commands:
build - Create table users.
get - show all users,
get <id> - show one user by id.
add <name> <email> - add new user.
update <id> name <name> email <email> - update one user by id. Can one argument name or email.
<?php
} else {
    switch ($argv[1]) {
      case "build":
        require 'app\databaseBuilder.php';
        $builder = new DatabaseBuilder();
        $builder->buildUser();
        break;
      case "get":
        $service = new UserService();
        $users;
        if ($argc == 3) {
          $id = $argv[2];
          $users = $service->getById($id);
        } else {
          $users = $service->getAll();
        }

        echo "id\t|\tname\t|\temail\t|\n";
        foreach ($users as $user) {
          echo "$user->id\t|\t$user->name\t|\t$user->email\t|\n";
        }
        break;
      case "add":
        $user = new User();
        $user->name = $argv[2];
        $user->email = $argv[3];
        $service = new UserService();
        $count = $service->add($user);
        if ($count > 0) {
          echo "Added.";
        }
        break;
      case "update":
        if ($argc > 4) {
          $service = new UserService();
          $id = $argv[2];
          $user = new User();
          for ($i=2; $i < $argc-1; $i++) {
            if ($argv[$i] == "name") {
              $user->name = $argv[$i + 1];
            }
            if ($argv[$i] == "email") {
              $user->email = $argv[$i + 1];
            }
          }
          $count = $service->update($id, $user);
          if ($count > 0) {
            echo "Updated.";
          }
        } else {
          echo "No arguments";
        }
        break;
      default:
        echo "Not exist command.";
        break;
    }
}
 ?>
