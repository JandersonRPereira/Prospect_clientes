const baseUrl = "http://localhost/testeCoopHolambra/geral.php";
const url = 'https://randomuser.me/api/?results=10';



async function init() {
    getUf();
    getClientes();
    // bcancel.addEventListener("click", clearSelection);
    // formEl.addEventListener("submit", onSubmit);
    // bdelete.addEventListener("click", onDelete);
  }
  init();


async function getUf() {
    await fetch(`${baseUrl}?act=getUf`)
    .then((resp) => resp.json())
    .then(function(data) {
        let comboEstados = document.getElementById("uf");
        
        for (let index = 0; index < data.length; index++) {
            const el = data[index];
            var opt = document.createElement("option");
            opt.value = el.id;
            opt.text = el.nome;
            comboEstados.add(opt, comboEstados.options[index]);
        }
    })
    .catch(function() {
        document.getElementById('uf').innerHTML = "<option value='0'>Nenhum valor</option>";
    });
}


async function getCidades() {
    var select = document.getElementById('uf')
    var opcaoValor = select.options[select.selectedIndex].value;
    let ret = await fetch(`${baseUrl}?act=getCidades&id=${opcaoValor}`)
    .then((resp) => resp.json())
    .then(function(data) {
        let comboCidades = document.getElementById("cidades");
        for (let index = 0; index < data.length; index++) {
            const el = data[index];
            var opt = document.createElement("option");
            opt.value = el.id;
            opt.text = el.nome;
            comboCidades.add(opt, comboCidades.options[index]);
        }
    })
    .catch(function() {
        document.getElementById('cidades').innerHTML = "<option value='0'>Nenhum valor</option>";
    });

}


async function validarDados() {
    let nome = document.querySelector("#nome").value;
    let email = document.querySelector("#email").value;
    let telefone = document.querySelector("#telefone").value;
    let cep = document.querySelector("#cep").value;
    let endereco = document.querySelector("#endereco").value;
    let numero = document.querySelector("#numero").value;
    let comp = document.querySelector("#comp").value;
    let uf = document.querySelector("#uf").value;
    let cidades = document.querySelector("#cidades").value;
    let documento = document.querySelector("#documento").value;

    let data = [
        {"nome": nome},
        {"email": email},
        {"telefone": telefone},
        {"cep": cep},
        {"endereco": endereco},
        {"numero": numero},
        {"comp": comp},
        {"uf": uf},
        {"cidades": cidades},
        {"documento": documento}
    ]

    let dataenv = JSON.stringify(data);
    await fetch(`${baseUrl}?act=insertPrespect&data=${dataenv}`);
    document.location.reload(true);
}


async function getClientes() {
    let ret = await fetch(`${baseUrl}?act=getClientes`)
    .then((resp) => resp.json())
    .then(function(data) {
        for (let index = 0; index < data.length; index++) {
            const el = data[index];
            let  item = `<tr><td>${el.nome}</td><td>${el.email}</td><td>${el.telefone}</td><td>${el.cidade}</td><td>${el.estado}</td><td>${el.documento}</td><td><button type='button' onClick="updateDados(${el.id})">Update</button><button type='button' onClick="deleteCliente(${el.id})">Delete</button></td>`; 
            let tb = document.getElementById('tbodyCli');
            tb.insertAdjacentHTML('afterbegin', item);
        }
    })
    .catch(function() {
        document.getElementById('tbodyCli').innerHTML = "<tr><td>Nenhum valor</td></tr>";
    });

}

async function updateDados(id){
    
    await fetch(`${baseUrl}?act=updateDados&id=${id}`)
    .then((resp) => resp.json())
    .then(function(data) {
        let nome = document.querySelector("#nome").value = data.nome;
        let email = document.querySelector("#email").value = data.email;
        let telefone = document.querySelector("#telefone").value = data.telefone;
        let cep = document.querySelector("#cep").value = data.cep;
        let endereco = document.querySelector("#endereco").value = data.endereco;
        let numero = document.querySelector("#numero").value = data.numero;
        let comp = document.querySelector("#comp").value = data.comp;
        let uf = document.querySelector("#uf").value = data.estado;
        let documento = document.querySelector("#documento").value = data.documento;
        getCidades()

        let form = document.getElementById("form")
        var ipt = document.createElement("input");
        ipt.type = 'hidden';
        ipt.value = data.id;
        ipt.name = 'id';
        ipt.id = 'id';
        form.appendChild(ipt);

        document.getElementById('cadastrar').style.display = 'none';
        document.getElementById('alterar').style.display = 'block';
    });

}


async function alterarDados() {

    let id = document.querySelector("#id").value;
    let nome = document.querySelector("#nome").value;
    let email = document.querySelector("#email").value;
    let telefone = document.querySelector("#telefone").value;
    let cep = document.querySelector("#cep").value;
    let endereco = document.querySelector("#endereco").value;
    let numero = document.querySelector("#numero").value;
    let comp = document.querySelector("#comp").value;
    let uf = document.querySelector("#uf").value;
    let cidades = document.querySelector("#cidades").value;
    let documento = document.querySelector("#documento").value;

    let data = [
        {"id": id},
        {"nome": nome},
        {"email": email},
        {"telefone": telefone},
        {"cep": cep},
        {"endereco": endereco},
        {"numero": numero},
        {"comp": comp},
        {"uf": uf},
        {"cidades": cidades},
        {"documento": documento}
    ]

    let dataenv = JSON.stringify(data);
    console.log(dataenv)
    await fetch(`${baseUrl}?act=alterarDados&data=${dataenv}`);
    document.location.reload(true);
}

async function deleteCliente(id){
    await fetch(`${baseUrl}?act=deleteCliente&id=${id}`);
    document.location.reload(true);

}