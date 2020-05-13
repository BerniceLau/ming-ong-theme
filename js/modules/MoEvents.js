import $ from 'jquery';

class MoEvents {
    // initiate our object
    constructor() {
        this.events();
    }
    
    // events
    events() {
        //$(".delete-note").on("click", this.deleteEvent);
        $("#my-notes").on("click", ".delete-note" ,this.deleteEvent);
        $(".submit-note").on("click", this.createEvent.bind(this));
    }
    
    // Methods will go here
    deleteEvent(e) {
        var thisEvent = $(e.target).parents("tr");
        
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', moData.nonce);
            },
            
            //url: moData.root_url + '/wp-json/wp/v2/event/' + thisEvent.data('id'),
            //type: 'DELETE',
            
            url: moData.root_url + '/wp-json/mo/v1/manageEvent',
            data: {'dataId': thisEvent.data('id')},
            type: 'DELETE',
            
            success: (response) => {
                thisEvent.slideUp();
                console.log(response);
            },
            
            error: (response) => {
                console.log(response);    
            }
        });
    }
    
    createEvent(e) {
        var newPost = {
            'frdate': $(".newfr_date").val(),
            'todate': $(".newto_date").val(),
            'time': $(".newtime").val(),
            'content': $(".newevent").val(),
        }
        
        $.ajax({
            
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', moData.nonce);
            },
            
            url: moData.root_url + '/wp-json/mo/v1/manageEvent',
            type: 'POST',
            data: newPost,
            
            success: (response) => {
                
                $(".newfr_date, .newto_date, .newtime, .newevent").val('');
                $(`
                    <tr data-id = ${response}>
                        <td>${newPost.frdate}</td>
                        <td>${newPost.todate}</td>
                        <td>${newPost.time}</td>
                        <td>${newPost.content}</td>
                        <td><span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i>删除</span></td>
                    </tr>
                  `).prependTo("#my-notes").hide().slideDown();
                console.log(response);
            },
            
            error: (response) => {
                console.log(response);
            }
        });          
    }
 }

export default MoEvents;