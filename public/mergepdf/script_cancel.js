
window.arrayOfPdf = []



function getBuffer(fileData) {
    return function(resolve) {
        var reader = new FileReader();
        reader.readAsArrayBuffer(fileData);
        reader.onload = function() {
            var arrayBuffer = reader.result
            var bytes = new Uint8Array(arrayBuffer);
            resolve(bytes);
        }
    }
}

async function joinPdf(filename) {
    var fileData;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', app_url+'/signed_pdf_files/'+filename, true);
    xhr.responseType = 'blob';
    xhr.onload = function(e) {
    if (this.status == 200) {
        var myBlob = this.response;
        //alert(myBlob);
        fileData = myBlob;
        // myBlob is now the blob that the object URL pointed to.
        // Pass getBuffer to promise.
        var promise = new Promise(getBuffer(fileData));
        promise.then(function(data) {
            window.arrayOfPdf.push({
                bytes: data,
                name: '1.pdf'
            })
            //listFilesOnScreen()
        }).catch(function(err) {
            console.log('Error: ', err);
        });
    }
    };
    xhr.send();    

    setTimeout(function() {
        var xhr2 = new XMLHttpRequest();
        xhr2.open('GET', app_url+'/certificate/'+filename, true);
        xhr2.responseType = 'blob';
        xhr2.onload = function(e) {
        if (this.status == 200) {
            var myBlob = this.response;
            //alert(myBlob);
            fileData = myBlob;
            // myBlob is now the blob that the object URL pointed to.
            // Pass getBuffer to promise.
            var promise = new Promise(getBuffer(fileData));
            promise.then(function(data) {
                window.arrayOfPdf.push({
                    bytes: data,
                    name: '2.pdf'
                })
                //listFilesOnScreen()

                /*
                setTimeout(function() {
                    alert("meget it called");
                    mergeit(filename);
                }, 5000);
                */
                mergeit(filename);

            }).catch(function(err) {
                console.log('Error: ', err);
            });
        }
        };
        xhr2.send();  
    }, 2000);
      


    /*
    setTimeout(function() {
        mergeit(filename);
    }, 5000);
    */
    
    
    
}

async function mergeit(filename)
{
    const mergedPdf = await PDFDocument.create();
    for (let document of window.arrayOfPdf) {
        document = await PDFDocument.load(document.bytes);
        const copiedPages = await mergedPdf.copyPages(document, document.getPageIndices());
        copiedPages.forEach((page) => mergedPdf.addPage(page));
    }
    var pdfBytes = await mergedPdf.save();
    //download(pdfBytes, "pdfconbined" + new Date().getTime() + ".pdf", "application/pdf");
    //alert("Review Submitted Successfully");

    console.log("merge it called");
    /*
    //alert("merge it called");   
    var ajax = new XMLHttpRequest();
    ajax.open("POST", app_url+"/merge_flatten_file?filename=output_"+filename,true);
    //ajax.open("POST", app_url+"/merge_flatten_file?filename=signed_"+filename,true);
    ajax.setRequestHeader("X-CSRF-TOKEN",document.getElementById('csrf-token').value);
    ajax.send(pdfBytes);
    console.log("merge it over");
    //alert("merge it over");

    setTimeout(function() {
        location.reload();
      },10000);
      */
    
    /*
    //alert("merge it called");   
    var xhr3 = new XMLHttpRequest();
    xhr3.open("POST", app_url+"/merge_flatten_file?filename=output_"+filename,true);
    //ajax.open("POST", app_url+"/merge_flatten_file?filename=signed_"+filename,true);
    xhr3.setRequestHeader("X-CSRF-TOKEN",document.getElementById('csrf-token').value);
    xhr3.send(pdfBytes);
    console.log("merge it over");
    //alert("merge it over");
    
    
    setTimeout(function() {
        location.reload();
      },10000);
    */


    
        
        var pdfBlob = new Blob([pdfBytes], { type: 'application/pdf' });
        var ajax = new XMLHttpRequest();
        var formData = new FormData();
        //formData.append('pdfFile', pdfBlob, doc_id+"_"+form_id+".pdf");
        formData.append('pdfFile', pdfBlob, filename);
            
        //ajax.open('POST', "save_flatten_file?document_id="+doc_id+"&form_id="+form_id, true);
        ajax.open('POST', "merge_flatten_file?filename="+filename,true);
        //ajax.open('POST', "merge_flatten_file?filename=output_"+filename,true);
        ajax.setRequestHeader("X-CSRF-TOKEN",document.getElementById('csrf-token').value);
        ajax.send(formData);
        ajax.onreadystatechange = function()
        {
            if(this.readyState==4 && this.status==200)
            {
                //alert("Merge submitted Successfully");
                //alert("Review submitted successfully");
                //location.reload();
            }   
        }
    
}

