

<?php



include('../Models/conexaoSearch.php');


$busca =  $_POST['busca'];


$query = mysqli_query($conn, "SELECT nome,email,cpf,gerente,setor FROM usuarios WHERE nome LIKE '%$busca%'");
$num   = mysqli_num_rows($query);
if($num >0){
	while($row = mysqli_fetch_assoc($query)){
		echo " <thead>
    <tr>
      <th>Nome</td>
        <th>Login</td>
          <th>Ativo</td>
            <th>Opções</td>  
            </tr>
          </thead>
          <tbody>


            <tr>

              <td>".$row['nome']."</td>
              <td>".$row['cpf']."</td>
              <td>".$row['gerente']."</td>
              <td>".$row['setor']."</td>

              <td>

                <button class='w3-button w3-theme w3-margin-top' onclick='deletar(".$row['id'].")'><i class='fas fa-user-times'></i></button>
                <button class='w3-button w3-theme w3-margin-top' onclick='editar(".$row['id'].")'><i class='fas fa-edit'></i></button>

              </td>

            </tr>

          </tbody>

          ";

        }
      }else{
       echo "Esta Pessoa Não Existe!";
     }

     ?>