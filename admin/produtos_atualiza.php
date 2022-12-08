<?php
// Incluindo o Sistema de autenticação
include("acesso_com.php");

// Incluir o arquivo e fazer a conexão
include("../conn/connect.php");


if($_POST){

    // Guardo o nome da imagem no banco e o arquivo no diretório
    if($_FILES['imagem_produto']['name']){
        $nome_img   =   $_FILES['imagem_produto']['name'];
        $tmp_img    =   $_FILES['imagem_produto']['tmp_name'];
        $dir_img    =   "../images/".$nome_img;
        move_uploaded_file($tmp_img,$dir_img);
    }else{
        $nome_img   =   $_POST['imagem_produto_atual'];
    };

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $id_tipo_produto    =   $_POST['id_tipo_produto'];
    $destaque_produto   =   $_POST['destaque_produto'];
    $descri_produto     =   $_POST['descri_produto'];
    $resumo_produto     =   $_POST['resumo_produto'];
    $valor_produto      =   $_POST['valor_produto'];
    $imagem_produto     =   $nome_img;

    // Campo do form para filtrar o registro (WHERE)
    $id      = $_POST['id_produto'] ;

    // Consulta SQL para atualização de dados
    $updateSQL  =   "UPDATE tbprodutos
                        SET id_tipo_produto     =   '$id_tipo_produto',
                            destaque_produto    =   '$destaque_produto',
                            descri_produto      =   '$descri_produto',
                            resumo_produto      =   '$resumo_produto',
                            valor_produto       =   '$valor_produto',
                            imagem_produto      =   '$imagem_produto'
                        WHERE id_produto = $id ";
    $resultado  =   $conn->query($updateSQL);
    if ( $resultado ) {
        header("Location: produtos_lista.php");
    }
    
};

// Consulta para trazer e filtrar os dados
if ($_GET){$id_form  =   $_GET['id_produto'];}
else{$id_form = 0;}
$lista          =   $conn->query("SELECT * FROM tbprodutos WHERE id_produto = $id_form");
$row            =   $lista->fetch_assoc();
$totalRows      =   ($lista)->num_rows;


// Selecionar os dados da chave estrangeira
$tabela_fk      =   "tbtipos";
$ordenar_por    =   "rotulo_tipo ASC";
$consulta_fk    =   "SELECT *
                    FROM ".$tabela_fk."
                    ORDER BY ".$ordenar_por." ";
// Fazer a lista completa dos dados
$lista_fk       =   $conn->query($consulta_fk);
// Separar os dados em linhas(row)
$row_fk         =   $lista_fk->fetch_assoc();
// Contar o total de linhas
$totalRows_fk   =   ($lista_fk)->num_rows;

?>
<!-- html:5 -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Produtos - Atualiza</title>
    <meta charset="UTF-8">
    <!-- Link arquivos Bootstrap CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS específico -->
    <link rel="stylesheet" href="../css/estilo.css" type="text/css">
</head>
<body class="fundofixo">
<?php include "menu_adm.php"; ?>
<main class="container">
    <div class="row"><!-- Abre row -->
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4"><!-- Dimensionamento -->
            <h2 class="breadcrumb text-danger">
                <a href="produtos_lista.php">
                    <button class="btn btn-danger">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualizar Produto
            </h2>
            <!-- Abre thumbnail -->
            <div class="thumbnail">
                <div class="alert alert-danger" role="alert">
                    <form action="produtos_atualiza.php" id="form_produto_atualiza" name="form_produto_atualiza" method="post" enctype="multipart/form-data">
                        <!-- Inserir o campo id_produto OCULTO para uso em filtros -->
                        <input type="hidden" name="id_produto" id="id_produto" value="<?php echo $row['id_produto']; ?>">

                        <!-- Select id_tipo_produto -->
                        <label for="id_tipo_produto">Tipo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                            </span>
                            <!-- select>option*2 -->
                            <select name="id_tipo_produto" id="id_tipo_produto" class="form-control" required>
                                <!-- Abre estrutura de repetição -->
                                <?php do { ?>
                                <option value="<?php echo $row_fk['id_tipo']; ?>"
                                    <?php
                                    if(!(strcmp($row_fk['id_tipo'],$row['id_tipo_produto']))){
                                        echo "selected=\"selected\"";
                                    };
                                    ?>
                                >
                                    <?php echo $row_fk['rotulo_tipo']; ?>
                                </option>
                                <?php } while($row_fk = $lista_fk->fetch_assoc()); 
                                $rows_fk = mysqli_num_rows($lista_fk);
                                if($rows_fk > 0){
                                    mysqli_data_seek($lista_fk,0);
                                    $rows_fk = $lista_fk->fetch_assoc();
                                };
                                ?>
                                <!-- Fecha estrutura de repetição -->
                            </select>
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha Select id_tipo_produto -->

                        <!-- radio destaque_produto -->
                        <label for="destaque_produto">Destaque?</label>
                        <div class="input-group">
                            <label for="destaque_produto_s" class="radio-inline">
                                <input type="radio" name="destaque_produto" id="destaque_produto" value="Sim" <?php echo $row['destaque_produto']=="Sim" ? "checked" : null; ?> >Sim
                            </label>
                            <label for="destaque_produto_n" class="radio-inline">
                                <input type="radio" name="destaque_produto" id="destaque_produto" value="Não" <?php echo $row['destaque_produto']=="Não" ? "checked" : null; ?> >Não
                            </label>
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha radio destaque_produto -->

                        <!-- text descri_produto -->
                        <label for="descri_produto">Descrição:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                            </span>
                            <input type="text" name="descri_produto" id="descri_produto" class="form-control" placeholder="Digite o título do produto." maxlength="100" required value="<?php echo $row['descri_produto']; ?>">
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha text descri_produto -->

                        <!-- textarea resumo_produto -->
                        <label for="resumo_produto">Resumo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                            </span>
                            <textarea name="resumo_produto" id="resumo_produto" cols="30" rows="8" placeholder="Digite os detalhes do produto." class="form-control"><?php echo $row['resumo_produto']; ?></textarea>
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha textarea resumo_produto -->

                        <!-- number valor_produto -->
                        <label for="valor_produto">Valor:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                            </span>
                            <input type="number" name="valor_produto" id="valor_produto" min="0" step="0.01" class="form-control" value="<?php echo $row['valor_produto']; ?>">
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha number valor_produto -->

                        <!-- File imagem_produto_atual -->                       
                        <label for="imagem_produto_atual">Imagem Atual:</label>
                        <img src="../imagens/<?php echo $row['imagem_produto']; ?>" alt="" class="img-responsive" style="max-width:50%;">
                        <!-- input type="hidden" >> campo oculto para guardar dados -->
                        <!-- guardamos o nome da imagem caso não seja alterada -->
                        <input type="hidden" name="imagem_produto_atual" id="imagem_produto_atual" value="<?php echo $row['imagem_produto']; ?>">
                        <br>
                        <!-- Fecha File imagem_produto_atual -->

                        <!-- file imagem_produto -->
                        <label for="imagem_produto">NOVA Imagem:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                            </span>
                            <!-- exibe a imagem a ser inserida -->
                            <img src="" alt="" name="imagem" id="imagem" class="img-responsive">
                            <input type="file" name="imagem_produto" id="imagem_produto" class="form-control" accept="image/*">
                        </div><!-- fecha input-group -->
                        <br>
                        <!-- Fecha file imagem_produto -->
                        
                        <!-- btn enviar -->
                        <input type="submit" value="Atualizar" name="enviar" id="enviar" class="btn btn-danger btn-block">
                    </form>
                </div><!-- Fecha alert -->
            </div><!-- Fecha thumbnail -->
        </div><!-- Fecha Dimensionamento -->
    </div><!-- Fecha row -->
</main>

<!-- Script para a imagem -->
<script>
document.getElementById("imagem_produto").onchange = function(){
    var reader = new FileReader();
    if(this.files[0].size>528385){
        alert("A imagem deve ter no máximo 500Kb");
        $("#imagem").attr("src","blank");
        $("#imagem").hide();
        $('#imagem_produto').wrap('<form>').closest('form').get(0).reset();
        $('#imagem_produto').unwrap();
        return false;
    };
    if(this.files[0].type.indexOf("image")==-1){
        alert("Formato inválido, escolha uma imagem!");
        $("#imagem").attr("src","blank");
        $("#imagem").hide();
        $('#imagem_produto').wrap('<form>').closest('form').get(0).reset();
        $('#imagem_produto').unwrap();
        return false;
    };
    reader.onload = function (e) {
        // obter dados carregados e renderizar miniatura.
        document.getElementById("imagem").src = e.target.result;
        $("#imagem").show();
    };  
    // leia o arquivo de imagem como um URL de dados.
    reader.readAsDataURL(this.files[0]);
};
</script>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php 
    mysqli_free_result($lista_fk);
    mysqli_free_result($lista);
?>
