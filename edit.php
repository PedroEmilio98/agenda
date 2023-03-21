<?php 
    require_once "templates/header.php";
    
?>

<div class="container">
        <?php require_once "templates/backbtn.php"; ?>
        <h1 id = "main-title">
            Editar Contato
        </h1>
        <form action="<?= $BASE_URL ?>config/process.php" method="POST" id="create-form">
            <input type="hidden" name="type" value="edit">
            <input type="hidden" name="contact_id" value="<?= $contact['id'] ?>">
            <div class="form-group">
                <label for="name">Nome do contato</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do usuário" value= "<?= $contact['name'] ?>" required>
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="DDDNNNNNNNNN" value= "<?= $contact['phone'] ?>" required>
                <label for="observations">Observações</label>
                <textarea class="form-control" id="observations" name="observations" placeholder="Digite os detalhes do contato" rows="3"><?= $contact['observations'] ?></textarea>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
        </form>
    </div>

<?php
    require_once "templates/footer.php";
?>