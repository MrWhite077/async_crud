async function showData(){
    document.querySelector("#readData").innerHTML="";
    let res = await fetch('./api/read.php');
        res = await res.json();

        for (const data of res) {
            // console.log(data);
            let tr=document.createElement("tr");

            for(let key in data){
                // console.log(data[key]);
                let td=document.createElement("td");
                td.innerText=data[key];
                tr.append(td)
            }
            document.querySelector('#readData').append(tr);
            let btnTd= document.createElement("td");
            let update= document.createElement("button");
            update.classList.add("btn");
            update.classList.add("btn-primary");
            update.setAttribute("data-bs-toggle","modal")
            update.setAttribute("data-bs-target","#updateModal")
            update.setAttribute("onclick","updateData(this)")
            update.innerText="update";
    
    
            let dltbtn= document.createElement("button");
            dltbtn.classList.add("btn");
            dltbtn.classList.add("btn-danger");
            dltbtn.setAttribute('onclick', 'deleteModal(this)');
            dltbtn.setAttribute("data-bs-toggle","modal")
            dltbtn.setAttribute("data-bs-target","#dltModal")
            dltbtn.innerText="delete";
    
            btnTd.append(update,dltbtn);
    
            tr.append(btnTd);
            
        }

    }