<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="max-width: 500px; width: 100%;">
        <div class="card-body bg-dark text-white rounded">
            <div class="mb-3">
                <input type="text" class="form-control form-control-lg text-end" id="display" value="0" disabled>
            </div>

            <div class="row g-2">
                <?php
                $buttons = [
                    ['7', '8', '9', '/'],
                    ['4', '5', '6', '*'],
                    ['1', '2', '3', '-'],
                    ['0', '%', '=', '+'],
                    ['C']
                ];
                foreach ($buttons as $row) {
                    foreach ($row as $btn) {
                        echo '
                        <div class="col-3">
                            <button class="btn btn-light w-100 py-3 btn-calc' . ($btn == 'C' ? ' btn-danger' : '') . '" data-value="' . $btn . '">' . $btn . '</button>
                        </div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    const layar = document.getElementById("display");
    const tombolKalkulator = document.querySelectorAll(".btn-calc");

    let isiSekarang = "";
    tombolKalkulator.forEach(tombol => {
        tombol.addEventListener("click", () => {
            const nilai = tombol.getAttribute("data-value");
            if (nilai === 'C') {
                isiSekarang = "";
                layar.value = "0";
            } else if (nilai === '=') {
                try {
                    isiSekarang = eval(isiSekarang).toString();
                } catch (err) {
                    isiSekarang = "Error";
                }
                layar.value = isiSekarang || "0";
            } else {
                isiSekarang += nilai;
                layar.value = isiSekarang;
            }
        });
    });

    document.addEventListener("keydown", (event) => {
        const tombol = event.key;

        if ((tombol >= '0' && tombol <= '9') || ['+', '-', '*', '/', '%'].includes(tombol)) {
            isiSekarang += tombol;
            layar.value = isiSekarang;
        } else if (tombol === 'Enter') {
            try {
                isiSekarang = eval(isiSekarang).toString();
            } catch (err) {
                isiSekarang = "Error";
            }
            layar.value = isiSekarang || "0";
        } else if (tombol === 'Backspace') {
            isiSekarang = isiSekarang.slice(0, -1);
            layar.value = isiSekarang || "0";
        } else if (tombol.toLowerCase() === 'c') {
            isiSekarang = "";
            layar.value = "0";
        }
    });
</script>
