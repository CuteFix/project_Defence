function encode( s ) {
    JSON.stringify(s)
    var encoded = new TextEncoder("utf-8").encode(s);
    var decoded = new TextDecoder("utf-8").decode(encoded);
    return decoded ;
}

sum1=function() {   
    "use strict";
    fetch("./miss.json")
    .then(function(resp){
        return resp.json();
    })
    .then(function(data){
        for (let i=0; i<data.length; i++)
        {
            if(data[`${i}`]['x2']<0.2){
                if(data[`${i}`]['x1']==1){
                    data[i] = encode("["+JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'1',},null,4));
                }
                else if(data[`${i}`]['x1']==data.length){
                    data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'1',},null,4)+"]");
                }else{
                    data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'1',},null,4));
                }
        }
        else if (data[`${i}`]['x2']<0.4){
            if(data[`${i}`]['x1']==1){
                data[i] = encode("["+JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'2',},null,4));
            }
            else if(data[`${i}`]['x1']==data.length){
                data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'2',},null,4)+"]");
            }else{
                data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'2',},null,4));
            }
        }
        else if (data[`${i}`]['x2']<0.6){
            if(data[`${i}`]['x1']==1){
                data[i] = encode("["+JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'3',},null,4));
            }
            else if(data[`${i}`]['x1']==data.length){
                data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'3',},null,4)+"]");
            }else{
                data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'3',},null,4));
            }
        }
        else if (data[`${i}`]['x2']<0.8){
            if(data[`${i}`]['x1']==1){
                data[i] = encode("["+JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'4',},null,4));
            }
            else if(data[`${i}`]['x1']==data.length){
                data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'4',},null,4)+"]");
            }else{
                data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'4',},null,4));
            }
        }
        else if (data[`${i}`]['x2']<=1){
            if(data[`${i}`]['x1']==1){
                data[i] = encode("["+JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'5',},null,4));
            }
            else if(data[`${i}`]['x1']==data.length){
                data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'5',},null,4)+"]");
            }else{
                data[i] = encode(JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:'5',},null,4));
            }

        }
        }
        console.log(data.x4)
        var blob = new Blob( [ data ], {
            type: 'application/octet-stream'
        });
        
            var url = URL.createObjectURL( blob );
            var link = document.createElement( 'a' );
            link.setAttribute( 'href', url );
            link.setAttribute( 'download', 'example.json' );
            
            var event = document.createEvent( 'MouseEvents' );
            event.initMouseEvent( 'click', true, true, window, 1, 0, 0, 0, 0, false, false, false, false, 0, null);
            link.dispatchEvent( event );
        
    })
};