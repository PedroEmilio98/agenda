<?php 
    require_once "templates/header.php";
?>
    <div class="container">
        <?php if(isset($printMsg) && $printMsg != ''): ?>
            <p id="msg"><?= $printMsg ?></p>
        <?php endif; ?>
        <h1 id="main-title">Minha agenda</h1>
        <?php if(count($contact) > 0): ?>
            <table class="table" id="contacts-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contact as $cont): ?>
                        <tr>
                            <td scope='row' id="col-id"><?= $cont["id"] ?></td>
                            <td scope='row'><?= $cont["name"] ?></td>
                            <td scope='row'><?= $cont["phone"] ?></td>
                            <td class="actions">
                                <a href="<?= $BASE_URL ?>show.php?id=<?= $cont['id'] ?>"><i class="fas fa-eye check-icon"></i></a>
                                <a href="<?= $BASE_URL ?>edit.php?id=<?= $cont['id'] ?>"><i class="fas fa-edit edit-icon"></i></a>
                                <form action="<?= $BASE_URL ?>/config/process.php" method="POST" id="delete-form">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $cont['id'] ?>">
                                    <button type="submit" id="remove-btn"><i class="fas fa-user-times delete-icon"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p id="empty-list-text">Ainda não há contatos na sua agenda, 
                <a href="<?= $BASE_URL ?>create.php">adicione um contato</a>
            </p>
        <?php endif; ?>
    </div>

<?php
    require_once "templates/footer.php";
?>
