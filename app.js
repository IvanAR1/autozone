const table = document.getElementById('data-table');
const searchInput = document.getElementById('searchInput');

// Función para cargar la tabla con datos obtenidos mediante fetch
function loadTable() {
  // Puedes reemplazar esta URL con la que corresponda a tu caso
  const apiUrl = './controller/index.php';

  fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
      renderTable(data);
    })
    .catch(error => console.error('Error fetching data:', error));
}

// Función para renderizar la tabla con los datos proporcionados
function renderTable(data) {
    table.innerHTML = '';

    // Crea encabezados de columna basados en las claves del primer objeto de datos
    data.forEach((index, key) => {
        if(key == 0){
            const headerRow = table.insertRow();
            Object.keys(index).forEach(key => {
                const th = document.createElement('th');
                th.textContent = key;
                headerRow.appendChild(th);
            });
        }
        const row = table.insertRow();
        Object.values(index).forEach(value => {
            const cell = row.insertCell();
            cell.textContent = value;
        });
    });
    return;
}

// Función para filtrar la tabla basándose en el valor del input de búsqueda
function searchTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td')[4];
        const cellValue = cells.textContent.toLowerCase();
        let found = false;

        if (cellValue.includes(searchTerm)) {
        found = true;
        }

        rows[i].style.display = found ? '' : 'none';
    }
}


// Cargar la tabla al cargar la página
loadTable();
