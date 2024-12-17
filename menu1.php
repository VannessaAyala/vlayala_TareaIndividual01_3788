<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú 1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        #background { position: absolute; width: 99%; height: 130%; }
        #fixed { position: relative; top: 0px; left: 0px; }

        .container {
            margin-top: 40px;
            max-width: 600px;
            background: #e0f0d9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        h1, label { color: #165014; font-weight: bold; }
        hr { border: 1px solid #165014; }
        .form-group { margin-bottom: 15px; }
        .form-control { background-color: #f9f9f9; border: 1px solid #ccc; color: #333; }
        button {
            background-color: #165014;
            color: white;
            transition: background 0.3s ease;
        }
        button:hover { background-color: #1d6e1d; }
        .alert {
            margin-top: 20px;
            font-weight: bold;
        }
        .fraction-input div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .fraction-input input {
            width: 100px;
            text-align: center;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div>
        <img id="background" src="Imagenes/fondo.jpg" alt="">
    </div>
    <div id="fixed" class="text-center">
        <img src="Imagenes/selloespe.jpg" alt="ESPE" height="100" style="margin-top: 3%;">

        <div class="container">
            <h1 class="text-center">MENÚ 1</h1>
            <hr>

            <!-- Formulario -->
            <form method="post" class="form-horizontal">
                <p>1. Factorial</p>
                <p>2. Primo</p>
                <p>3. Serie Matemática</p>
                <p>S. Salir</p>
                <hr>

                <div class="form-group">
                    <label for="option" class="control-label col-sm-4">Seleccione una opción:</label>
                    <div class="col-sm-8">
                        <select id="option" name="option" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="1" <?= isset($option) && $option == '1' ? 'selected' : '' ?>>1 - Factorial</option>
                            <option value="2" <?= isset($option) && $option == '2' ? 'selected' : '' ?>>2 - Primo</option>
                            <option value="3" <?= isset($option) && $option == '3' ? 'selected' : '' ?>>3 - Serie Matemática</option>
                            <option value="S" <?= isset($option) && $option == 'S' ? 'selected' : '' ?>>S - Salir</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="number" class="control-label col-sm-4">Ingrese un número (0-10):</label>
                    <div class="col-sm-8">
                        <input type="number" id="number" name="number" class="form-control" min="0" max="10" value="<?= isset($number) ? $number : '' ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-block">Calcular</button>
                    </div>
                </div>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $option = $_POST['option'];
                $number = isset($_POST['number']) ? intval($_POST['number']) : null;

                // Validar el número ingresado
                if ($number !== null && ($number < 0 || $number > 10)) {
                    $error = "El número debe estar en el rango de 0 a 10.";
                } else {
                    switch ($option) {
                        case '1': // Factorial
                            if ($number !== null) {
                                $factorial = 1;
                                for ($i = 1; $i <= $number; $i++) {
                                    $factorial *= $i;
                                }
                                $result = "El factorial de $number es: $factorial";
                            } else {
                                $error = "Debe ingresar un número para calcular el factorial.";
                            }
                            break;

                        case '2': // Primo
                            if ($number !== null) {
                                if ($number < 2) {
                                    $isPrime = false;
                                } else {
                                    $isPrime = true;
                                    for ($i = 2; $i <= sqrt($number); $i++) {
                                        if ($number % $i === 0) {
                                            $isPrime = false;
                                            break;
                                        }
                                    }
                                }
                                $result = $isPrime ? "$number es un número primo." : "$number no es un número primo.";
                            } else {
                                $error = "Debe ingresar un número para verificar si es primo.";
                            }
                            break;

                        case '3': // Serie Matemática
                            if ($number !== null) {
                                $serie = 0;
                                $sign = 1;
                                for ($i = 1; $i <= $number; $i++) {
                                    $term = $sign * (pow($i, 2) / factorial($i));
                                    $serie += $term;
                                    $sign *= -1;
                                }
                                $result = "El resultado de la serie matemática es: " . number_format($serie, 4);
                            } else {
                                $error = "Debe ingresar un número para calcular la serie matemática.";
                            }
                            break;

                        case 'S': // Salir
                            $result = "¡Hasta luego!";
                            header("Location: index.html");
                            break;

                        default:
                            $error = "Opción inválida.";
                    }
                }
            }

            function factorial($n) {
                $factorial = 1;
                for ($i = 1; $i <= $n; $i++) {
                    $factorial *= $i;
                }
                return $factorial;
            }
            ?>

            <?php if (isset($result)): ?>
                <div class="alert alert-success">
                    <strong>Resultado:</strong> <?= $result ?>
                </div>
            <?php elseif (isset($error)): ?>
                <div class="alert alert-danger">
                    <strong>Error:</strong> <?= $error ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
