function previewImg(){
    var fileSelected = document.getElementById('upload').files;
    if(fileSelected.length > 0 ){
        var fileToLoad = fileSelected[0];
        var fileReader = new FileReader();
        fileReader.onload = function(fileLoaderEvent){
            var srcData = fileLoaderEvent.target.result;
            var newImg = document.createElement('img');
            newImg.src = srcData;
            document.getElementById('displayImg').innerHTML = newImg.outerHTML;
        }   
        fileReader.readAsDataURL(fileToLoad);
    }
}