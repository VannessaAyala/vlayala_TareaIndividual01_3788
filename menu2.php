<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú 2</title>
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #background { position: absolute; width: 99%; height: 130%; }
        #fixed { position: relative; top: 0px; left: 0px; }
        
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #e0f0d9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: #165014;
            
        }
        h1, label { color: #165014; }
        hr { border: 1px solid #165014; }
        button {
            background: #165014;
            color: #333;
            transition: background 0.3s;
        }
        button:hover { background: #165014; }
        .fraction-input div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .fraction-input label {
            margin-right: 10px;
            width: 20px;
        }
        .fraction-input input {
            width: 100px;
            margin-right: 5px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <img id="background" src="Imagenes/fondo.jpg">
    </div>
    <div id="fixed">
        <div class="text-center">
            <img src="Imagenes/selloespe.jpg" alt="ESPE" height="100" style="margin-top: 5%;">
        </div>

        <div class="container">
            <h1 class="text-center">MENÚ 2</h1>
            <hr>
            <p class="text-center">1. Fibonacci</p>
            <p class="text-center">2. Cubo</p>
            <p class="text-center">3. Fraccionarios</p>
            <p class="text-center">S. Salir</p>
            <hr>

            <form method="post">
                <div class="form-group">
                    <label for="option">Seleccione una opción:</label>
                    <select id="option" name="option" class="form-control" required onchange="updateInputs()">
                        <option value="">Seleccione...</option>
                        <option value="1">1 - Fibonacci</option>
                        <option value="2">2 - Cubo</option>
                        <option value="3">3 - Fraccionarios</option>
                        <option value="S">S - Salir</option>
                    </select>
                </div>

                <div id="inputs">
                    
                </div>

                <button type="submit" class="btn btn-success btn-block">Calcular</button>
            </form>

            <?php
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $option = $_POST['option'];
                $result = '';
                $error = '';

                switch ($option) {
                    case '1': // Fibonacci
                        $n = intval($_POST['fibonacci_n']);
                        if ($n < 1 || $n > 50) {
                            $error = "El número debe estar entre 1 y 50.";
                        } else {
                            $fibonacci = [1, 1];
                            for ($i = 2; $i < $n; $i++) {
                                $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
                            }
                            $result = "Los primeros $n números de Fibonacci son: " . implode(", ", $fibonacci);
                        }
                        break;

                    case '2': // Cubo
                        $resultados = [];
                        for ($i = 1; $i <= 1000; $i++) {
                            $suma = 0;
                            $num = $i;
                            while ($num > 0) {
                                $digito = $num % 10;
                                $suma += pow($digito, 3);
                                $num = floor($num / 10);
                            }
                            if ($suma === $i) {
                                $resultados[] = $i;
                            }
                        }
                        $result = "Los números que cumplen la condición son: " . implode(", ", $resultados);
                        break;

                    case '3': // Fraccionarios
                        $num_a = intval($_POST['num_a']);
                        $den_a = intval($_POST['den_a']);
                        $num_b = intval($_POST['num_b']);
                        $den_b = intval($_POST['den_b']);
                        $num_c = intval($_POST['num_c']);
                        $den_c = intval($_POST['den_c']);
                        $num_d = intval($_POST['num_d']);
                        $den_d = intval($_POST['den_d']);

                        if ($den_a <= 0 || $den_b <= 0 || $den_c <= 0 || $den_d <= 0) {
                            $error = "Los denominadores deben ser mayores que 0.";
                        } else {
                            $resultado = ($num_a / $den_a) + ($num_b / $den_b) * ($num_c / $den_c) - ($num_d / $den_d);
                            $result = "El resultado de la operación es: " . number_format($resultado, 4);
                        }
                        break;

                    case 'S': // Salir
                        $result = "¡Hasta Luego!";
                        header("Location: index.html");
                        break;

                    default:
                        $error = "Opción no válida.";
                }
            }
            ?>

            <?php if (!empty($result)): ?>
                <div class="alert alert-success mt-3">
                    <strong>Resultado:</strong> <?= $result ?>
                </div>
            <?php elseif (!empty($error)): ?>
                <div class="alert alert-danger mt-3">
                    <strong>Error:</strong> <?= $error ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function updateInputs() {
            const option = document.getElementById('option').value;
            const inputs = document.getElementById('inputs');
            inputs.innerHTML = '';

            if (option === "1") {
                inputs.innerHTML = `
                    <label>Ingrese un número (del 1 al 50):</label>
                    <input type="number" name="fibonacci_n" class="form-control" min="1" max="50" required>
                `;
            } else if (option === "3") {
                inputs.innerHTML = `
                    <label>Ingrese 4 fraccionarios:</label>
                    <div class="fraction-input">
                        <div><label>A:</label> <input type="number" name="num_a" required> / <input type="number" name="den_a" required></div>
                        <div><label>B:</label> <input type="number" name="num_b" required> / <input type="number" name="den_b" required></div>
                        <div><label>C:</label> <input type="number" name="num_c" required> / <input type="number" name="den_c" required></div>
                        <div><label>D:</label> <input type="number" name="num_d" required> / <input type="number" name="den_d" required></div>
                    </div>
                `;
            }
        }
    </script>
</body>
</html>
