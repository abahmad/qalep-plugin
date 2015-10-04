
window.qalep_elements = [
    {"type": "item", "label": "item", "id": "1", },
//    {type: "container", label: "container", columns: [[], []], id: "2"},

    {"label": "Section", "type": 'container', "columns": [[]], "properties": {fixed: 'true'}},
    {label: "Cloumn", type: 'column', columns: [[]], properties: {width: '12', offset: '0'}},
    {label: "title", type: "title", properties: {
            Title: "title",
            Border:
                    {input_type: "radio",
                        choices: {
                            bottom: "two-btm",
                            around: "two-side"
                        },
                        value: "two-btm"},
            Alignment: {
                input_type: "radio",
                choices: ["text-center", "text-left", "text-right"],
                value: "text-left"
            }
        },
    },
    {label: 'Clear', type: 'clear'},
    {label: "Post", type: 'post', properties:
                {numberposts: '1',
                    post_type: '',
        pagination:
                {input_type: "radio",
                    choices: [
                        "pagination-default",
                        "pagination-soft",
                        "pagination-color",
                        "pagination-cir"
                    ],
                    value: 'pagination-default',
                }
            },
    },
    {label: "Testimonial",
        type: 'testimonial',
        properties: {text: '', image: '', personName: '', personPosition: '', size:
                    {input_type: "radio",
                        choices:
                                {meduim: '6',
                                    large: '12'},
                        value: '6'}
            ,
            template:
                    {input_type: "radio",
                        choices: ['in box', 'with popup'],
                        value: 'in box'},
        }
    },
    {label: "Divider", type: 'divider', properties:
                {shape:
                            {input_type: 'radio',
                                choices: ['thin', 'dashed', 'slash'],
                                value: 'thin'}
                },
    },
    {label: "Counting", type: 'counting', properties:
                {percent: "34.2%",
                    size: "200",
                    borderWidth: "40",
                    bgFill: "#f7f7f7",
                    frFill: "#fa9011",
                    textSize: "15",
                    textColor: "#585858"},
    },
    {label: "Content Box", type: 'content_box',
        properties:
                {template:
                            {input_type: "radio",
                                choices: ['box1', 'box2', 'box3'],
                                value: 'box1',
                            },
                    title: 'TITLE OF THE BLOCK IN HERE',
                    text: 'Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.'},
    },
    {label: "Alert", type: 'alert', properties:
                {text: '', image: '',
                    background:
                            {input_type: 'radio',
                                choices: ['gray', 'orange', 'light-gray'],
                                value: 'gray'},
                },
    },
    {label: "Button", type: 'button', properties: {
            value: 'button',
            border:
                    {input_type: "radio",
                        choices: ['flat', 'round'],
                        value: 'flat'
                    },
            color:
                    {input_type: "radio",
                        choices: ['gray', 'white', 'orange'],
                        value: 'white'
                    },
            size:
                    {input_type: "radio",
                        choices: ['sm', 'md', "lg"],
                        value: 'md'},
        },
    },
    {label: "People", type: 'people'
        , properties: {
            template:
                    {input_type: "radio",
                        choices: ['2', '3', '4', '6'],
                        value: '4'},
            Social:
                    {input_type: "radio",
                        choices: ['f', 't', 'g+', 'p'],
                        value: 'f'},
            name: 'Full name',
            position: 'position',
            text:"write description on",
            image: '',
        }
    },
    {label: "Text", type: "text", properties: {
            text: 'Your text',
            title: '',
            textalign:
                    {input_type: "radio",
                        choices: ['text-center', 'justify'],
                        value: 'justify'},
        },
    },
    {label: "Url", type: 'url',
        properties: {
            slug: '',
            link: 'www.link.com'},
    },
    {
        label: "Image",
        type: 'image',
        imgSrc: ''
    }
];
