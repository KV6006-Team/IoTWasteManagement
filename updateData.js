const getData = async () => {
    let url = "http://localhost/getData.php"
    let res = await fetch(url)
    let data = await res.json()
    return data
  }

const capToColour = val => {
    let x = 600
    let gt = (x / 3)
    let ot = (x / 3) * 2
    let rt = x

    if(val < gt) return "green"
    if (val > gt && val < ot) return "orange"
    if (val > ot) return "red"
}
  
  const outputToTable = data => {
    let table = document.getElementById("table")
    table.innerHTML = ""
    data.forEach( e => {
        table.innerHTML += `<br> ${e.binName} :<span class='${capToColour(e.capacity)}'> ${e.capacity}</span>`
    })
}


  const updatePage = async () => {
    let data = await getData()

    let select = document.getElementById("locSelect")

    let filteredData = data.filter( e => e.locationID.toLowerCase() === document.querySelector('#locSelect').value.toLowerCase())

    outputToTable(filteredData)
  }

  updatePage()
  setInterval(updatePage, 1000)