    document.addEventListener("DOMContentLoaded", function () {
        const menuTable = document.getElementById("daftarMenu");

        const style = document.createElement('style');
        style.textContent = `
            #daftarMenu {
                background-color: rgba(253, 246, 239, 1);
                width: 100%;
                margin: auto;
                text-align: center;
                padding-top: 50px;
                padding-bottom: 100px;
            }

            .judulMenu {
                color: rgba(222, 108, 56, 1);
                margin-top: 10%;
                font-size: 36px;
                font-weight: 600;
            }

            #rowMenu {
                color: black;
                margin: 5%;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 120px;
            }

            .card-Chicken, .card-Burger, .card-Steak, .card-Spaghetti, .card-Beverage {
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 20px;
                cursor: pointer;
                overflow: hidden;
                display: flex;
                text-align: center;
                align-items: flex-end;
                box-sizing: border-box;
                padding: 20px;
                flex-direction: column;
                justify-content: flex-start;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            }

            .card-Chicken {
                width: 260px;
                height: 180px;
            }
            .card-Burger {
                width: 260px;
                height: 180px;
            }
            .card-Steak {
                width: 260px;
                height: 180px;
            }
            .card-Spaghetti {
                width: 260px;
                height: 180px;
            }
            .card-Beverage {
                width: 180px;
                height: 260px;
            }

            .card-contentChicken {
                position: relative;
                padding: 20px;
                cursor: pointer;
                width: 230px;
                height: 155px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .card-contentChicken p {
                font-size: 13px;
                margin-top: 10%;
                color: #333;
            }

            .card-chickenTitle {
                color: rgba(78, 38, 26, 1);
                font-size: 18px;
                margin-bottom: 5px;
            }

            .card-chickenPrice {
                color: rgba(222, 108, 56, 1);
                text-align: left;
                margin-left: 0;
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 10px;
            }

            /* Atur gambar supaya responsive dan rapi */
            .card-Chicken img,
            .card-Burger img,
            .card-Steak img,
            .card-Spaghetti img,
            .card-Beverage img {
                width: 100%;
                height: auto;
                border-radius: 15px;
                margin-bottom: 10px;
                object-fit: cover;
            }
        `;
        document.head.appendChild(style);


        fetch("menu.php")
            .then(response => response.json())
            .then(data => {
                const daftarMenu = $('#daftarMenu');
                daftarMenu.empty();
                data.menu.forEach(category => {
                    // Tambah baris kategori
                    let categoryRow = `
                        <h1 class="judulMenu" id="menu-${category.category}">${category.category}</h1>
                        <div class="rowMenu">`;

                    category.items.forEach(item => {
                        const itemRow = `
                            <div>
                                <img src="images/${item.img_directory}.png" alt="${item.name}" class="card-${category.category}">
                                <div class="card-contentChicken">
                                    <h2 class="card-chickenTitle">${item.name}</h2>
                                    <h3 class="card-chickenPrice">Rp${item.price}</h2>
                                    <p>${item.description}</p>
                                </div>
                            </div>`;
                        categoryRow += itemRow;
                    });
                    const endCatRow = `
                    </div>`;
                    categoryRow += endCatRow;
                    menuTable.innerHTML += categoryRow;
                });
            })
            .catch(error => {
                console.error("Gagal memuat data:", error);
                menuTable.innerHTML = "<tr><td colspan='2'>Gagal memuat data menu.</td></tr>";
            });
    });