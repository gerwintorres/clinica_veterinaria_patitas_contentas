<?php
    $pagina_actual = '';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include '../includes/templates/header.php';
    require '../config/funciones_alertas.php';
    if(isset($_SESSION['exito'])){
        alertaExitoso('INICIO DE SESIÓN EXITOSO');
        unset($_SESSION['exito']);
    }
?>

<h1 class="contenedor titulo-h1-pagina alineacion-izquierda">Bienvenido(a) administrador(a)</h1>

<main class="contenedor main-inicio-sesion">
    <a class="card" href="colaboradores/colaboradores.php">colaboradores
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_26_360)"/>
            <defs>
            <pattern id="pattern0_26_360" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_26_360" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_26_360" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAERElEQVR4nO2cTYgdRRCAa41/ERQ1kGX3Vc1M1TxR40kW9OaqEfUQk7yNVbMYUBDNQUG9iIiIipccAvEHFBXUk3gUxYPGv0NAPSxJ/IuLGFw1oAQ9qCSBuD7pTUyM0biPzJvu7ekP6vIOM68+eut193YXQCKRSCQSiUQikUgkBqNLVcmotwvpC0z6vpDNCerPTHZISH8TtG/c50z6aDefvnzAx7ebsbE15zDq3Yw6I2T9QYJR3ylpw2W+cwidEUa7g0n3DSr4uEA9wGgbfScTJJeMr18hqG+dkuDjQudLqtb5zisoup0eMtlX9Uk+UkbcX0am9zDZTTLaWwltJstuuUDIvqxb8om12w4y2stE0+PQQkaY9M1hS/5H/d7LqFdAmyjJbm1U8rH4qSimcmgD3e6NZzHZ955Eu/gA2kDR0Ts9Sl6IgqrrIXaE9EPfogV1G8QM8/Sod8kL0z87hKgXQqyUaOt9Sz4qO+YVpJBuCUe0boVYYdL3fAs+GmhvQ6ww6acBlY6vIVYEdW8wokn3QawI6oGARvRBiBUm+zWcEW2/QKwI6axvwcdCZyFWpNYN/lMuHe9CrAjqwwGVjscgVorO9JW+Bf8VBdpVEDOCttu3ZEHbA/DIaRAzTPqUd9FkT0PMlJ3qavdfav+idb5AnYRYEdTX/Us+HIz6GsQKo37mW/DfRvUuiBUh+zgg0R9BrAjZ8+GUDnsWYqUgXRuM6KxaA/Giy4TskzDqc+Tz6CxTFtKdHkXvyPOqgLbAHhYujPYktI3CQ72OvC7/O6tW6ZmM9mNjolF/mJjYdAa0ESG7r0HR90NbmYTJ0xtZLaLtQdTl0GbKjl0z3I0mnZesWu07zyBg0oeG9gNI9qDv/EK7lfXqECS/4p7tO7nA0GVunlubZLTnWjvLWAx1iV7Uy9qMJNFJdFRIGtFJdFRIGtENSM6q1bXNo9Nq8KS9Ombqm0frjHvmf7yunXS7G89zjU1qX4Kjbrt4xdpzfecXAiOc6c3DvLLMZN9xxza0cikuo72VjHZXowceUb9YeGfs/Tu6nR6WmW4S1DcON6BqSPAJofOMul0yfcA1yIIYuCibEiG9dyExsj/8yT1JaUH73HUaKzOdgKVEnleXMtrmsO6r2GJH+6z77i4HCJQR6VRTR0ZuAMKshpGu211OwfyIFmg3uJM/vsXI8Eb5TpejN8F5vu58RnvJvwhrZoSTvuhyblRylvXGwjhDZ80G2u5yvKIGZxI25z1p8hZzzsHwG0/VuB8hSzZ0V57fdnbsN6r6IQSjPTG047Z+V3QWWvw+lJWloD0TQHL9wKLe+4puX1fI9geQWD+w2F/rmT7O7LoAkur/XwyaVy3vzfTa+kSTPu5bogQqutYuCa6jlm+JEqho14OkPtFLZC8DfIgm21GbaM/dcfshi2bSb2sTvVRmHOBBtHNTm+hEIpFIJBKJRCKRAA/8Ca+3NBl2iM95AAAAAElFTkSuQmCC"/>
            </defs>
        </svg>
    </a>
    <a class="card" href="proveedores/proveedores.php">Proveedores
        <svg width="91" height="90" viewBox="0 0 91 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect x="0.5" width="90" height="90" fill="url(#pattern0_26_359)"/>
            <defs>
            <pattern id="pattern0_26_359" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_26_359" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_26_359" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEUUlEQVR4nO2cTYgdRRCAa/0F/1CDWbKvat7rmifqCoIE43EVDQb/kl2teosRD2JySESPwaioeHDFg4lKQDzoTa8qHuL/QZJcgkoOGsTEYGKQoAcjSSDEyGTXjXF5svN2Zqq3uz/oyx52qr+tV9vTr7oBEolEIpFIJBKJRCJRji71cofyKJO85Ui+YNIDjPK7Iz3JJH8y6k/Fzx3J89325M0lf33cLFt27yUOZaND2c2kp8sMh/JpTg/caD0H3xlyqI85kiNlBZ8zUI471LXWk/GS60fWLGGU7QsSfM6QUzn1VlvPyyu6rXF0pD9UJ3mmjBSfjEyecKT38fD4UoiZLHvoKib9vmrJc2u3nnCo7xBNjkCEDDmSj+qW/J/6fcih3gIxkZM+0qjks+O3TmeiDTHQ7a662JEeNBJdjC8hBjotWWcoebpuk6yE0GGSndaiGeUTCBkeHl9qLvlMRutJRLkaQiVHXWMteVZ2yG+QTPqKP6LlVQgVR/K5teDZgbIdQsWR7PGodPwIocIoh7wRTXIEQoVRjnuU0ScgVBzpUX8yWv+AUGGSvdaCzw7ZC6HClW7wL7h0fAahwijPelQ6XoBQ6bQmb7UW/M/ooIxByDDqd9aSGXUfwHPnQcgw6evmoknfgJDJW3p78S21vWg5lbd6t0GoMMoH9pJny8f7ECrOo70OJvkWQoVJdnkkeieEikN906PSsQ1ChVt6t7ngmZGjrIKQcShfWUt2pDuKJh4ImSwTxyTfGIr+ut3udSAWHOrWxjMZdSvEhis6PZvO5kzugdgYHZWLHOqvjUlGPbx8+foLIUY4k03NlQ15HGI+s8Io+2uXTLJnDMYugJhxJCvr3WgKfAOpDIz6TH3ZrE9Zz8+3U1nv1VAy3g3+xaQ8cn6Va+tiXyXaVcZ8qEr0vB4WM5xEJ9FBwQs7nrzFoawYHn74Uut5eA8PtoT72bUmb7KOfVHBg2RyklxScta7Y4Bl3Jaa/uZB39Wxu7xoWWEd+6Kh2117RXGxySD1efQaucw6/sXAkMvkwYUcWf7f/W6Slxn1l6rW5gMe9J8qYgGrg50OdUMVDY/9nlFM0Ezw3P8jU41egpJnsp5RPpy+gKqaSfR7nmkmz8lsPVyr3GuzCWaSJ2daDP6qYxJ9RVvLnWecA9Nu926Y/tg2c14FIhM9xK3ehEVzDMQiuoN6V9GZ6dsEeIBvYuazOphZzWxuTHS7vfpKh/q2r5nCNa7Hr1ty/+WNiM5HeuTFWRSqMqNlc4mMfrp20dMrCT1gLZgrFm0VZ/+LpwbYj+AkupxoR/KatVgOPaOLdtsq3+g4ie6TIajbrKVy6Bl9pkeO9Jh1sBy6aJfpndaBchSiSV60DpRjEM2oH1sHylGINtzL4JhEG9+Oezoa0b6uODg00YsR9kBuEk1JdGVYZ3DKaEqiK8U6g1NGUxId8M2+ehBCxXnUEsaoL0Hgh/qnTDP7X02OfwPMPm1Qc6UlkwAAAABJRU5ErkJggg=="/>
            </defs>
        </svg>
    </a>
    <a class="card" href="productos/productos.php">Productos
        <svg width="91" height="90" viewBox="0 0 91 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect x="0.5" width="90" height="90" fill="url(#pattern0_26_361)"/>
            <defs>
            <pattern id="pattern0_26_361" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_26_361" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_26_361" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFZklEQVR4nO2dS4gcRRiAK1mNT1ARHXbnr56pf1qQ8aCwPg4+Il5UCCab8P+zRDEHJagoiIJe1OSixIvgSVDjAxHUICQuBD34hPiIoiJBERTFg8RHkERXEzBZ+Wd2yBCnp3t2e6qqe+qDuu32VH/7Tz3/qlUqEAgEAoFAIBAIBAJ2QKSzTNRaY4C3IdAbCPS10fQbap43mg8h0H7U9CUC70CgRxrV1rW12qZTLVWv6NAEVlvrEXiXAT6CmheGKQbooAF+oQ58jes38ZQtKw3QbQbou2HlJhf6uA58ves384ZGRNMG+LP8BJ9QgHc1plpajTErjKb7ltJELKEcaOjWWjV+0ARqftaC4N5yzGjaqsaFOL7hFASay9S5af4VNT9tgG+uV2eviKsz0GzSKgA67YJoPWLEVzYi2myAX0FNf2V7Jj2uxkGy0bQ7w+jhU1PlDavV6pOyPrtSueUM1HQnAv2Qod1+QI255AOoaZO030v9HBlLI9DDKW3/sbqmm9SYSv4EJynK6zMN8GVG008DmqXfpSlS4yWZ3pSvfu6fXZ0BmVEOaKJ2qnGRbDTtlp8bWR2qMzAosgs/qWk2aVV7jSIlkm2sT6CevTS5zaa9qqjEHkTyicjCU3JdWlerohF7KPn4aIR/7N9W8/OqSMSeSu5igO9KGFf/4apOpZPcM6npO4MsxNJqXADJXRDotYSofkj5TNOj0UUWUNMdCaJfVb4SFyiSuxigyxMmL58rH4kLKFm4cGrduQkR/bPyjWbBmos+a+H91j4OKZ+ICxrJx9myUlbv+tR7XvlCXHjJnTSG/k0H7Vc+UAbJQm2KLknoDPcp15RFstDQfKuXS6ZlkiwYTc8ljDoeVa4o9uji/0xPbz5Zdla8WpcuWyQLdU2c0BH+0zyPzlS2KaNk1RnWfZHwLq9br045JStZIr096X0awOsKKbmhN1zU2fKnF1HTM7KQI1Nf5YgoIiNrzgl9zLcS7YWSXJNdjHaqFx3tM3w6KBmjyjLS9g5KopThXqEkV9qL6vze4BFK+zlbLaefvTVgxPTRcpJ1hkLSrtJy4fKSjBZlpwWPAT5cr/LFyhIrOu3o8iQbTe9mlWxDdpZvaAP4HmULA3z/ciYjk5NrTjfAbw8ruSeqtrmZZPFL1pqMxUz7I7YjGUcY2ZnSz4DmhslSzeHMyIDjDEAf2JCMOcr2cvwvw6xBFYojag5sLnR+kvOQ7aVk2cpJOf00nyL5nbwlL0e2p5KVkkz61Jfuk6c8asm4BNneShbkOFjqywLtlN67+ztRtPEcG5JxCNleS67V1p6d+biZJHADPYbAT8hWvC3JmEG215IFObdhWxguR3afcXYhNiPk6JdreTi87Kdk51rq3wCKUdP73kZyl6zn+zws/xrgX1L/KD5I7ojmbzyQtjCSyPdFsrB438VC+Qr5tUGMmv92L4XLG8ldZNbnWgyWOZK7ZOlQilPIT8kCav7KvSAut2RB8hfcS+JyS0471FiEYnzs+PqBEV3nWhaWOZK7SEUlv8K9NC5nJPci98K5FodljeRe5ISoe3lc3kjuxWj+0LVELGsk9yJJ1+5FcnkjedgtrRDJOSDXSHZu5XItlssZyb3INZIJhxuD5LzBiB50LRnL0PFlQXacZbvIiWSguVI2FwPH1+1bxq2K3m4x4dCvDtIA7Rl5pwd82ADdrcYbmmjf6yz36I9EMu2xmWnvPViZOd8AP5n1umBMF7wPgTZaSwAvGpJGhprv7Uzb6ehQcjX/iZpfxmrrRqtHzIqOMbMVBJrp/MsO3iGnmiRXxAB/v7hNJgeGtsv9zKjpKjl77brOgUAgEAgEAoFAIKDGhf8AhkRxVMIPbeUAAAAASUVORK5CYII="/>
            </defs>
        </svg>
    </a>
    <a class="card" href="inventario/inventario.php">inventario
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_26_362)"/>
            <defs>
            <pattern id="pattern0_26_362" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_26_362" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_26_362" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEWUlEQVR4nO2dS4gcVRSGrxnFPBbqwkx6+pyqvqdbwUVAGB+JgpNsNGA0jHJODRrJKlkGREHURRBcG7INyc63kAlZKiL42KgLwRcKvgkhRoImMT6SWHJ7ZtLDkKrunqrUrb5zPjirkJ5/vjl1qqr73mpjFEVR6g8AryGQFwn4B0L5j1DSygr4uAU5EEWP3WRCptPZdj0Bv1+p3CuUBfkyjnfcaELFIj/pW3Kvu+UlEyoW+CPvghe6GvlnEyoE8r1vwb3iSyZUCORH/4J7ZVayaIvyCwFP0/j0end1MFxNN2yTd1qU31Q09um0SO4t+ge1TXlURWNONwP/YYy5pqjo8fGd61Q05l5y/W5KII53rVbRmD864gm+vajoNvA2FY19ZjTwVxbkzuWNEB5rN5MthPKTisaBL7/+JODTQxXKeb28M3odXRmkNywqOihIO1pFBwVpR6vooCDtaBUdFKQdraKDgrSjVXRQkHa0ig4K0o5W0UFhUb71vWhmySfuYUI1WEm6+LNJEyoWeL93wb06aEKlBTxVA8HdamFyvwkZi/yeb8kE8kEZK6JqDQFvtChnfUl2CyDtRHKrWQlQxA92121ULRnkZNyUTWYl0Y54kpA/q0YyXyKQt+KYN5iVyb5VbomtBXm9uxsA+K9yOpf/nduBxR9alBfiOLnN92+qKIqiKIpSC/atIpAZi3KEkD+2IJ9WUeR+FvKsBXncZeifk8daET9hgY9a4E+qyjn3s/io23I3WM6M8AT8pq9bZerdMh+ZMlPXZqV0/0bAx/zn5Nm8nJlQxHt9h6fLNyDyVE7OZ3znW6gW8NPDi67s9lgKvUlPyN/UJ6d8PbRon++w0ZKyKBdycl4YhZyZlPW+Q1llsnLWINsgOYuJBjnRQn7YPb5n2NcH4DXu/7rXqED0+VaTdxPxDcvJaVEeKpqzkGgnyhSkjcmOqy3aIj9XNGdXti/Ry+nkpTQa29deddHAd5kyHrqloiX/yGvO3D3SokdodDxfNGf3fOJLtDtBOFHu8B/29RuN7Wu7kkfgZFjGSTsTvbyTQf6AKpo8lXY0qui0ghmtHU0FD0nfYnV0oIpOy+wU3x2sHY0qOtWO1huWVEdHBr5nss5oVNGpzujFh6R+Zpjq6FiE75msMxpVdKozevEhqTM6rWR0uE3pvucdzZdFOZOdU/4ZhZxm1Ne00YAP5fadMxOL/Jr34Hi5DuXknK1BvoU6PLzoKOEaBE/7bZB3C9BrkxPkgWUtRLfAX/gOb0HezUs5Obnnulo8cKXIRv52lNxjQf72Jhnl1zZwp2/Opmzt7pb1lpNPFd7I30ZOvMgGPk44c8egOQl5lxfZICfKWNs3J3uCN1vkzysKf5GQX+5s4JuHzdkCuc+d+avKaVFedd/pZcqFx+a/g+qV7neloJwpJzCfsyDfEcjbFuXZDibtIindhh13FBLIG3PS+VxZOecfDPCOW8tHzUduKc+toiiKuRL/A+6XcBbS+UHhAAAAAElFTkSuQmCC"/>
            </defs>
        </svg>
    </a>
    <a class="card" href="historias/historias_clinicas.php">Historias clínicas
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_37_56)"/>
            <defs>
            <pattern id="pattern0_37_56" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_37_56" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_37_56" width="90" height="90" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFoAAABaCAYAAAA4qEECAAAACXBIWXMAAAsTAAALEwEAmpwYAAADt0lEQVR4nO2dzU4UQRDH24NfUS8agyxdvXTtEhO8aEg8aqIePBgTYqrgQOKNkx8nWY8efAEfQV9Bn0H0hCaoCXj05sEYCMREwfSAgSyw7rLTU70z9U/6wvb2VP2orZ6p6ekxRqVSqVQqlWpgVK/fP4FAjxH4PQKtIvDmYDdaRaB36OhRs3n7uElBzZFJi0Af5eFwLOgfgo8pRHKJIfMObMnI3k4Xm1VoDcsPBUGHnCwPAYuJ6nkx0B54RR4AF9KCr2KgpZ3HgpuCBgUtHoWoEc295UjLv9DSE+cmh0NDy3PZ3xR0zhFleW7PHOGopaBzBu3c5HA76HqdLijogvIjaupQ0LkphWjCBGyIrnwmOfqMjm6Mn6fTzfr0FW/pJQJv9AF6I4wRxrp47u4ZdFM30fKXqoNea9SmoH1cb+lqqC30Dprmw3fb+4RjhGNVF7Sl1x2GP+JHaMYDf/sf6NAn9A3fObCf5TcKuoOGhmZOoeXnB30ePgt9Oo2x3a/SoNeLuHuRpQ5L69UFDdnPfrleo8uxbAxje0tf87DVSCkP43FrEvuDll95Pz2Ul23W0llv+QUC/87LTjP4oPlfdK94oGf93J+bmJg9mt1is/wjb/uMlPJ2BHeAL3k3Rb3a4x3f8pYWY9llSgr6Tq/2KGjoEnL4uTtq9Zs6Go5mPdB3jWhoh6yTYfTU4YGXop/eAS9XPUevjVkaKWTZWqUvWGzHWkcmvQTXotJgpQ6A6VrsMmk4RrXLpBCWEdDiqOVrYWVqA+5dyqvwH8aylk6OWrruLX+q+mS42a+TKdgQXSk4iQnYEF0pOIkJ2BBdRToJ+0ya4RxcQecN21Fr7z+anironEH7sKDRUStEdna65qilixwLTCmoObp8zUhJ2nFU0PJQUCOaxYFp6oC0m+ZoUNDiUYga0SwOrlSpY+uxNZ7br1YhrV6vMMUMPWyNIjV1+xidnIGHfGwtNXX7GJ2Ygd0Yl2LKOGy51UipNKkDuiu3pj8Zuq3ypklM5ZoMS9SMgmYFLR2FqBHN4uA0dYA8VM3RoKDFax0Q+e542mcdAhcsGGkLoKL92HEo0VpHPdIWQEZK3RgncUU4FmmpmJFSsqkD4iwVK9qPXQ6lVeuASk+GJWpGQbOClo5C1IhmcXCaOkAequZoqCDoSm09b+mn5FmHvkyhCIU371Qooh8YKYWdYsLLYKQhYPy2MD5Ox8RA73qFU5lhLxSxp0jXkR3evJPtLlCCCdJn28Lx25AuxCNZpVKpVCqVyvSiv5j5vzxbsM3yAAAAAElFTkSuQmCC"/>
            </defs>
        </svg>
    </a>
    <a class="card" href="clientes/clientes.php">Gestionar clientes
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_26_364)"/>
            <defs>
            <pattern id="pattern0_26_364" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_26_364" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_26_364" width="90" height="90" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
    </a>
</main>
<div class="ultima-fila-card contenedor">
    <a class="card last" href="procedimientos/procedimientos.php">Precios procedimientos
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_26_365)"/>
            <defs>
            <pattern id="pattern0_26_365" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_26_365" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_26_365" width="90" height="90" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
    </a>
    <a class="card last" href="guarderia/programacion_guarderia.php">Programación guardería
        <svg width="90" height="90" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <rect width="90" height="90" fill="url(#pattern0_45_104)"/>
            <defs>
            <pattern id="pattern0_45_104" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_45_104" transform="scale(0.0111111)"/>
            </pattern>
            <image id="image0_45_104" width="90" height="90" xlink:href="data:image/png;base64,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"/>
            </defs>
        </svg>
    </a>
</div>
<?php
    include '../includes/templates/footer.php';
?>