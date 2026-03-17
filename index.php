<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca da Turma</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>📚 Biblioteca da Turma</h1>
        <h2>O que estamos lendo?</h2>
        
        <!-- Formulário de cadastro -->
        <div class="form-card">
            <h3>Cadastrar novo livro</h3>
            <form action="cadastrar.php" method="POST">
                <div class="form-group">
                    <label for="titulo">Título do livro:</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>
                
                <div class="form-group">
                    <label for="autor">Autor(a):</label>
                    <input type="text" id="autor" name="autor" required>
                </div>
                
                <div class="form-group">
                    <label for="aluno">Nome do aluno(a):</label>
                    <input type="text" id="aluno" name="aluno" required>
                </div>
                
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status">
                        <option value="lendo">Estou lendo</option>
                        <option value="lido">Já li</option>
                    </select>
                </div>
                
                <button type="submit" class="btn">Cadastrar livro</button>
            </form>
        </div>
        
        <!-- Lista de livros -->
        <div class="list-card">
            <h3>📖 Livros cadastrados</h3>
            
            <?php
            require_once 'config.php';
            
            try {
                $stmt = $pdo->query("SELECT * FROM livros ORDER BY data_cadastro DESC");
                $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($livros) > 0) {
                    echo "<table>";
                    echo "<tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Aluno</th>
                            <th>Status</th>
                            <th>Ação</th>
                          </tr>";
                    
                    foreach ($livros as $livro) {
                        $status_emoji = ($livro['status'] == 'lendo') ? '📖' : '✅';
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($livro['titulo']) . "</td>";
                        echo "<td>" . htmlspecialchars($livro['autor']) . "</td>";
                        echo "<td>" . htmlspecialchars($livro['aluno']) . "</td>";
                        echo "<td>" . $status_emoji . " " . $livro['status'] . "</td>";
                        echo "<td>
                                <a href='excluir.php?id=" . $livro['id'] . "' 
                                   class='btn-excluir' 
                                   onclick='return confirm(\"Tem certeza que deseja excluir?\")'>
                                   🗑️ Excluir
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p class='empty-message'>Nenhum livro cadastrado ainda. Seja o primeiro!</p>";
                }
            } catch(PDOException $e) {
                echo "<p class='error'>Erro ao carregar livros: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>