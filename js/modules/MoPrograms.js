import $ from 'jquery';

class MoPrograms {
    
    constructor() {
        this.events();
    }
    
    events() {
        $(".delete-note").on("click", this.deleteProgram);
        $(".submit-note").on("click", this.createProgram.bind(this));
    }
    
    //methods
    deleteProgram(e) {
        var thisProgram = $(e.target).parents("tr");
        
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', moData.nonce);
            },
            
            url: moData.root_url + '/wp-json/mo/v1/manageProgram',
            data: {'dataId': thisProgram.data('id')},
            type: 'DELETE',
            
            success: (response) => {
                thisProgram.slideUp();
                console.log(response);
            },
            
            error: (response) => {
                console.log(response);    
            }
        });
    }
    
    
    createProgram(e) {
        var cellname = "";
        
        var newPost = {
            'progdate': $(".newdate").val(),
            'cell': $(".newcell").val(),
            'program': $(".newprogram").val(),
            'planner': $(".newplanner").val(),
            //'status': 'publish'
        }
        
        $.ajax({
            
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', moData.nonce);
            },
            
            url: moData.root_url + '/wp-json/mo/v1/manageProgram',
            type: 'POST',
            data: newPost,
            
            success: (response) => {
                
                $(".newdate, .newcell, .newprogram, .newplanner").val('');
                
                if(newPost.cell == 1){
                    cellname = "乐龄团契";
                } else if (newPost.cell == 2) {
                    cellname = "妇女会";
                } else if (newPost.cell == 3) {
                    cellname = "成年团契";
                } else if (newPost.cell == 4) {
                    cellname = "初成团契";
                } else if (newPost.cell == 5) {
                    cellname = "青年团契";
                } else if (newPost.cell == 6) {
                    cellname = "少年团契";
                } else if (newPost.cell == 7) {
                    cellname = "儿童团契";
                } else if (newPost.cell == 8) {
                    cellname = "女少年军";
                } else if (newPost.cell == 9) {
                    cellname = "男少年军";
                }
                
                $(`
                    <tr data-id = ${response}>
                        <td>${newPost.progdate}</td>
                        <td>${cellname}</td>
                        <td>${newPost.program}</td>
                        <td>${newPost.planner}</td>
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

export default MoPrograms;