<?php
// Inicializa valores (mantém os inputs após submit)
$homens = isset($_POST['homens']) ? (int)$_POST['homens'] : 0;
$mulheres = isset($_POST['mulheres']) ? (int)$_POST['mulheres'] : 0;
$criancas = isset($_POST['criancas']) ? (int)$_POST['criancas'] : 0;

$showResult = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($showResult) {
    // cálculos por categoria
    $carne_total = $homens*500 + $mulheres*300 + $criancas*200;
    $frango_total = $homens*200 + $mulheres*200 + $criancas*100;
    $linguica_total = $homens*200 + $mulheres*200 + $criancas*200;
    $refri_total = $homens*300 + $mulheres*400 + $criancas*200;
    $cerveja_total = $homens*800 + $mulheres*500;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Calculadora de Churrasco</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        :root{
            --accent: #b30000;
            --muted: #666;
            --card-bg: #fff;
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family: Inter, Arial, Helvetica, sans-serif;
            background:#fafafa;
            color:#222;
            display:flex;
            flex-direction:column;
            align-items:center;
            padding:28px 16px;
        }

        .container{
            width:100%;
            max-width:760px;
        }

        h1{
            color:var(--accent);
            margin:6px 0 18px;
            text-align:center;
        }

        /* Tabela com valores no topo */
        .tabela {
            width:100%;
            background:var(--card-bg);
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 4px 10px rgba(0,0,0,0.05);
            margin-bottom:18px;
            border:1px solid #eee;
        }
        .tabela table{
            width:100%;
            border-collapse:collapse;
        }
        .tabela thead th{
            text-align:left;
            padding:12px 14px;
            background:#fff;
            color:var(--muted);
            font-weight:600;
            border-bottom:1px solid #f0f0f0;
        }
        .tabela tbody td{
            padding:12px 14px;
            border-bottom:1px solid #f7f7f7;
            color:#333;
        }
        .tabela tbody tr:last-child td{ border-bottom:0; }

        /* Formulário */
        .form-card{
            background:var(--card-bg);
            padding:14px;
            border-radius:12px;
            box-shadow:0 4px 10px rgba(0,0,0,0.03);
            border:1px solid #f0f0f0;
            margin-bottom:18px;
            display:flex;
            gap:12px;
            align-items:center;
            justify-content:center;
            flex-wrap:wrap;
        }
        .form-item{
            display:flex;
            flex-direction:column;
            align-items:center;
            min-width:120px;
        }
        label{ font-size:14px; color:var(--muted); margin-bottom:6px; }
        input[type=number]{
            width:110px;
            padding:8px 10px;
            border-radius:8px;
            border:1px solid #e6e6e6;
            text-align:center;
            font-size:15px;
        }
        .btn{
            padding:10px 18px;
            background:var(--accent);
            color:#fff;
            border-radius:10px;
            border:0;
            cursor:pointer;
            font-weight:600;
            margin-top:6px;
        }

        /* Resultado por categoria */
        .resultado{
            background:var(--card-bg);
            padding:16px;
            border-radius:12px;
            border:1px solid #f0f0f0;
            box-shadow:0 6px 18px rgba(0,0,0,0.03);
        }
        .categoria{
            margin-bottom:12px;
        }
        .categoria h3{
            margin:0 0 8px 0;
            color:var(--accent);
            font-size:16px;
        }
        .categoria ul{
            margin:0;
            padding-left:18px;
            color:#333;
        }
        .categoria ul li{
            margin:6px 0;
            font-size:14px;
        }

        /* responsivo */
        @media (max-width:480px){
            .form-item{ min-width:100%; }
            input[type=number]{ width:100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Calculadora de Churrasco</h1>

        <!-- Tabela com os valores de referência -->
        <div class="tabela" aria-hidden="false">
            <table>
                <thead>
                    <tr>
                        <th>Itens</th>
                        <th>Homens</th>
                        <th>Mulheres</th>
                        <th>Crianças</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Carne bovina</td>
                        <td>500 g</td>
                        <td>300 g</td>
                        <td>200 g</td>
                    </tr>
                    <tr>
                        <td>Frango</td>
                        <td>200 g</td>
                        <td>200 g</td>
                        <td>100 g</td>
                    </tr>
                    <tr>
                        <td>Linguiça</td>
                        <td>200 g</td>
                        <td>200 g</td>
                        <td>200 g</td>
                    </tr>
                    <tr>
                        <td>Refrigerante</td>
                        <td>300 ml</td>
                        <td>400 ml</td>
                        <td>200 ml</td>
                    </tr>
                    <tr>
                        <td>Cerveja</td>
                        <td>800 ml</td>
                        <td>500 ml</td>
                        <td>—</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Formulário -->
        <form method="post" class="form-card" novalidate>
            <div class="form-item">
                <label for="homens">Homens</label>
                <input id="homens" name="homens" type="number" min="0" value="<?php echo $homens; ?>">
            </div>

            <div class="form-item">
                <label for="mulheres">Mulheres</label>
                <input id="mulheres" name="mulheres" type="number" min="0" value="<?php echo $mulheres; ?>">
            </div>

            <div class="form-item">
                <label for="criancas">Crianças</label>
                <input id="criancas" name="criancas" type="number" min="0" value="<?php echo $criancas; ?>">
            </div>

            <div style="display:flex; align-items:center;">
                <button type="submit" class="btn">Calcular</button>
            </div>
        </form>

        <!-- Resultado -->
        <?php if ($showResult): ?>
            <div class="resultado" aria-live="polite">
                <h2 style="margin-top:0; color:var(--muted);">Resultado do cálculo</h2>

                <?php if ($homens > 0): ?>
                    <div class="categoria">
                        <h3>Homens: <?php echo $homens; ?></h3>
                        <ul>
                            <li>Carne bovina: <?php echo $homens*500; ?> g</li>
                            <li>Frango: <?php echo $homens*200; ?> g</li>
                            <li>Linguiça: <?php echo $homens*200; ?> g</li>
                            <li>Refrigerante: <?php echo $homens*300; ?> ml</li>
                            <li>Cerveja: <?php echo $homens*800; ?> ml</li>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($mulheres > 0): ?>
                    <div class="categoria">
                        <h3>Mulheres: <?php echo $mulheres; ?></h3>
                        <ul>
                            <li>Carne bovina: <?php echo $mulheres*300; ?> g</li>
                            <li>Frango: <?php echo $mulheres*200; ?> g</li>
                            <li>Linguiça: <?php echo $mulheres*200; ?> g</li>
                            <li>Refrigerante: <?php echo $mulheres*400; ?> ml</li>
                            <li>Cerveja: <?php echo $mulheres*500; ?> ml</li>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($criancas > 0): ?>
                    <div class="categoria">
                        <h3>Crianças: <?php echo $criancas; ?></h3>
                        <ul>
                            <li>Carne bovina: <?php echo $criancas*200; ?> g</li>
                            <li>Frango: <?php echo $criancas*100; ?> g</li>
                            <li>Linguiça: <?php echo $criancas*200; ?> g</li>
                            <li>Refrigerante: <?php echo $criancas*200; ?> ml</li>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    </div>
</body>
</html>