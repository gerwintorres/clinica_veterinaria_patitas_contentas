<?php
    $pagina_actual = '';
    include 'includes/templates/header.php';
    require_once 'config/funciones_alertas.php';

    if(isset($_SESSION['codigo'])){
        alertaRegistro('Contraseña restablecida exitosamente');
        unset($_SESSION['codigo']);
    }
?>

<h1 class="contenedor titulo-h1-pagina">Iniciar sesión</h1>

<main class="contenedor main-inicio-sesion">
    <a class="card" href="./iniciar_sesion_cliente.php">cliente 
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_33_1276)"/>
            <defs>
            <pattern id="pattern0_33_1276" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_33_1276" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_33_1276" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAGjElEQVR4nO2de4jUVRTHr9rLsqLM1t059zdzz8yqbFiCBUGSvZOy0LVzZn2EWSRZUf0VvbeIMnoSRfQmrSTKIqMkMCu0CCQjIqK3hVlQllkmlbrGmV1z1ZnfY37zm9+dmfuB8597f/f3nfu795xzz70q5XA4HA6Hw2EVADTceHSB0bwEgT4zmv9ATVuM5i8N8AsmQ3MKhSkHpt3PhmWymrxfLkOXItAG1LzTz4zmH1DT3LT73HCMaZ95FGp+N0jgMoIv6eqiA9Luf0PQ6XUjAn8bVeTdYtNyN5UEUCjMPswAfVqtyIPsnqBntTQI9GINRN6JwD+l/S7Wgh6f5C8grTEZnoFIhwPQkahpktH8SrMLDUDDUdNlBuh9o3lj7AYRaJXPCF2oFA0r93cG6NF9/z3dqZoAk+k5FjV/PvjdYjXoeWR8RvPD/n9NwwzwXTKKS26ez4/SSOQ9mojAv++tR6xG0aOryo9k2tA1ikaoFsPzZh3RHxvsq0msho2mNyq4arerFgQ1P1/pC4/VsAH+plyj2QyfqFqMfKZ4ip9TEKtxyV2UFTpLo1WLYIBPMMDPGM1/+gZkwH+jpo8lxxP9IZq3lWt04sT5+6smJ5ul0ahpKWruixovGODLIz3MaP65XEPjOqaNVE0MlmIB+iVGcLZV656O0A+sFHbngE9WTSwyat4aQ+QBh4HvDv9Q4MWtlLPATHenRHlxRd7lAivVOzTUgw3QxRUa+Q3bph+tmoiuUTRi72gvruUzfGqoh/fnLvivCmK/1gyR3i5Q87O1FHlgUXxMhaVszuL/hmhRM3ggWCkCjj198CZJMYfqRCdQxgBtrtwgrcll+DjVoBjJPGrakYjQA7tLob981LTA/xOhf1HTvZ43vT3sC6LuOR6BbjbAK43mr/o3d3l7af4H/k7Sj6jpOaPp1jzwtFyuOxtH0LJ9AJ7XH2gkI/JusenlbHbuQaE6ZTQ9HWJO+kemkxzw2ZWmlDzQlH4Rq+r0rwi0QlynnCaW7bXqBKbxBujVpAXed00LgWyuIvCyCA3LyFyGwNeK8Nls9zjU/HgCn+ZG1PQmAt+BQDMljSlRnYwg+bEl45YHKmCGz0GgW1DTB3UVeJAekUoNUPNTqXRUN7rRE1V8ejwvKMnijPcYzVHWrz0oZKaDVCRVk3TBFrLSuuXxGVWJvOfopvGSEK/H6o0NZrJ+5HTxLFXrKiYDdMXArkz5aLJljHZIDlu+epUksuIb4NnpvzAnZ0DrZAdql4k3I/6yAboS28lT9cIAXZK6GDoZM5reUbZQ94BA11NoPk/ZgtRJN6nIG0PnmetBLXYp0EqjpcomBpJEzSj0AmUTcWqp0WqjScompPA8fVG45pa4bxwVKWpMWxRMwMaOPP9QZROSGk1bFKy99VnlcQjt7VMPbrb8hwHarGxEIqi0xcHa2vfKRoymG5tsRL+lrK2Ot0AgrJUB36csZQgC/5i6QLo2JhvLylYkLxvj5fpQ8yelMoS0hQbeFLpkIA3kLHi1L2c0LS+1kenujLQDn4w9pGym4FFX9ULz9YPbQq94ugH6KAWRt1oXEVao0qx2RJ9ZpskhxitOjVGEU820sVDZTrVCG6DNQXNiXs84Rs4yGs3rkxQ6my3mlO1UPXUAPxL+Kb1Dsx00ATVfM1AdtamWQuc6aKyynbxH86O/HG2puuCkRO9QKYqUOV3Oa4v/2/8D0CoD/KEB+rp0sYuUrYUZ0R00QdlOFRep9CHQrDqfWfEX2vZzlQOFjVEqmfpQ03X17KPpKI4J7JdHpymbMcAPRpku8pqK6VwHETAYPDpX2YocJgpbsWQ0r09zHgy6iEtuQ1O2UqpXDiMy0NpIhx+T6etqX6/DowuVrYTybYFWtLXNOST1vgIt8uuneE7KVoJcJwP0nsyPygKMphsC1o+rla2Ivxog9APKEmSxCxC6rp5QJHyON++MfNgxYeSIX8BifZuylcBqUuDFyiKkDLcmB+hTufnRX+iXVONsUNidi/YrCzOa3paUp7IEOTrn4x2tQ+CbJIpUNiKnaQNG9eokTsTGSOcGVMCWjjI/KTUryiYkGRPCl96QdsAS5hawvRbylbZdNjBEik5qm3tOPAm2PZF7k5JGfNDgjtMXyhIQ+P5wQtNaZRO+l6vo3XOfLQujTAkI/Hqg0Jq3WVfwiJouCrp1q2DV/wdAwyTslnvs/BZIY3ra0u6pw+FwOBwOh8PhcDgcDofD4XCoxuQ/oHjrAF25bZwAAAAASUVORK5CYII="/>
            </defs>
        </svg>
    </a>
    <a class="card" href="./iniciar_sesion_medico.php">Médico
        <svg width="91" height="90" viewBox="0 0 91 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect x="0.5" width="90" height="90" fill="url(#pattern0_33_1278)"/>
            <defs>
            <pattern id="pattern0_33_1278" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_33_1278" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_33_1278" width="90" height="90" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
    </a>
    <a class="card" href="./iniciar_sesion_admin.php">Administrador
        <svg width="91" height="90" viewBox="0 0 91 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect x="0.5" width="90" height="90" fill="url(#pattern0_33_1279)"/>
            <defs>
            <pattern id="pattern0_33_1279" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_33_1279" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_33_1279" width="90" height="90" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
    </a>
</main>
<?php
    include 'includes/templates/footer.php';
?>