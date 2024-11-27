<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-star"></i>
                /AI-Text</h2>
        </template>
        <div class="beforForm">
                    <div class="title">
                        <div class="logo">
                            <p v-html="pages.logo" :style="{backgroundColor: pages.color , color: pages.logo_color}"></p>
                            <span class="title">{{ pages.title }}</span>
                            <div class="plan_level">
                                <p v-if="pages.premium" class="Premium"><i class="fa-solid fa-gem"></i>Premium</p>
                                <p v-if="pages.pro" class="Pro"><i class="fa-solid fa-crown"></i>Pro</p>
                                <p v-if="pages.Free" class="Free"><i class="fa-solid fa-gift"></i>Free</p>
                            </div>
                        </div>
                        <div class="star">
                            <label class="container">
                                <input type="checkbox"  @click="addFavorit_text(pages.id)" :checked="pages.id === pages.id_tool">
                                <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                            </label>
                        </div>
                    </div>
                    <div class="description">
                        <p class="description">{{pages.description}}</p>
                    </div>
        </div>
        <div class="text_tools_template">
            <div class="first_part">
                <div class="words_balence" v-if="$page.props.auth.user.special_user">
                    Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / Unlimited
                </div>
                <div class="words_balence" v-else-if="$page.props.auth.user.payment">
                    Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / {{ curentToken }}
                </div>
                <div class="words_balence" v-else>
                    Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / {{ curentToken }}
                </div>
                <form @submit.prevent="sendMessage">
                    <div class="wrapper_feild">
                            <input class="faild_hidden-trigger" id="feild_toogle" type="checkbox" :checked="edit_feild_checkbox">
                            <label class="feild_circle" for="feild_toogle" @click="edit_faild_button_fun()">
                                <i class="fa-solid fa-plus"></i>
                            </label>
                            <div class="feild_subs">
                                <span class="sub-feild_circle sub-feild_circle1">
                                    <input class="hidden-sub-trigger" id="faildsub1" type="radio" name="sub-feild_circle" value="1">
                                    <label for="faildsub1" @click="add_faild_frame_fun()"><i class="fa-solid fa-plus"></i></label>
                                </span>
                                <span class="sub-feild_circle sub-feild_circle2">
                                    <input class="hidden-sub-trigger" id="faildsub2" type="radio" name="sub-feild_circle" value="2">
                                    <label for="faildsub2" @click="open_edit_buttons_fun()"><i class="fa-solid fa-pen-to-square"></i></label>
                                </span>
                                <span class="sub-feild_circle sub-feild_circle3">
                                    <input class="hidden-sub-trigger" id="faildsub3" type="radio" name="sub-feild_circle" value="3">
                                    <label for="faildsub3" @click="open_remove_buttons_fun()"><i class="fa-solid fa-trash"></i></label>
                                </span>
                            </div>
                    </div>
                    <div class="inputs">
                    <label for="">Language</label>
                    <select name="" id="" class="input" required v-model="language">
                        <option value="English" selected>English</option>
                        <option value="French">French</option>
                        <option value="Spanish">Spanish</option>
                        <option value="German">German</option>
                        <option value="Italian">Italian</option>
                        <option value="Portuguese">Portuguese</option>
                        <option value="Russian">Russian</option>
                        <option value="Arabic">Arabic</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Korean">Korean</option>
                    </select>
                    </div>
                    <div class="inputs" v-for="(field, index) in fields_input" :key="index">
                        <label>{{ field.title }}</label>
                        <input v-if="field.type === 'text'" type="text" class="input" :placeholder="field.title" v-model="fields_input[index].content" required>
                        <textarea v-else :placeholder="field.title" v-model="fields_input[index].content" required></textarea>
                    </div>
                    <div class="inputs" v-for="(field, index) in fields_input_custom" :key="index">
                        <label>{{ field.title }}</label>
                        <div @click="edit_faild_frame_fun(field.id,field.title,field.type)" v-if="open_edit_buttons" :style="{animation: open_edit_buttons? 'showbut .5s forwards ease':''}" class="hover_button"></div>
                        <Link :href="`/ai_tools_template/${field.id}/destroy`" v-if="open_remove_buttons" :style="{animation: open_remove_buttons? 'showbut .5s forwards ease':''}" class= "hover_button delete"></Link>
                        <input v-if="field.type === 'text'" type="text" class="input" :placeholder="field.title" v-model="fields_input_custom[index].content" required>
                        <textarea v-else :placeholder="field.title" v-model="fields_input_custom[index].content" required></textarea>
                    </div>
                    <div class="inputs_sub">
                        <div class="section">
                            <div class="inputs">
                                <label for="">Creativity</label>
                                <select name="" id="" class="input" v-model="Creativity">
                                    <option value="Repetitive">Repetitive</option>
                                    <option value="Deterministic"> Deterministic</option>																															
                                    <option value="Original" selected> Original</option>																															
                                    <option value="Creative"> Creative</option>																															
                                    <option value="Imaginative"> Imaginative</option>
                                </select>
                            </div>
                            <div class="inputs">
                                <label for="">Number of Results </label>
                                <input type="number" class="input" v-model="Number_of_Results">
                            </div>
                        </div>
                        <div class="section">
                            <div class="inputs">
                                <label for="">Tone of Voice</label>
                                <select name="" id="" class="input" v-model="Tone_of_Voice" required>
                                    <option value="Professional" selected> Professional</option>	
                                    <option value="Exciting"> Exciting</option>	
                                    <option value="Friendly"> Friendly</option>	
                                    <option value="Witty"> Witty</option>	
                                    <option value="Humorous"> Humorous</option>	
                                    <option value="Convincing"> Convincing</option>	
                                    <option value="Empathetic"> Empathetic</option>	
                                    <option value="Inspiring"> Inspiring</option>	
                                    <option value="Supportive"> Supportive</option>	
                                    <option value="Trusting"> Trusting</option>	
                                    <option value="Playful"> Playful</option>	
                                    <option value="Excited"> Excited</option>	
                                    <option value="Positive"> Positive</option>	
                                    <option value="Negative"> Negative</option>	
                                    <option value="Engaging"> Engaging</option>	
                                    <option value="Worried"> Worried</option>	
                                    <option value="Urgent"> Urgent</option>	
                                    <option value="Passionate"> Passionate</option>	
                                    <option value="Informative"> Informative</option>
                                    <option value="Funny">Funny</option>
                                    <option value="Casual"> Casual</option>																																																														
                                    <option value="Sarcastic"> Sarcastic</option>																																																																																												
                                    <option value="Dramatic"> Dramatic</option>	
                                </select>
                            </div>
                            <div class="inputs">
                                <label for="">Estimated Result Length  </label>
                                <input type="number" class="input" v-model="Estimated_Result_Length">
                            </div>
                        </div>
                    </div>
                    <div class="generate_butt">
                        <div class="button" type="submit">
                            <div class="sp">
                                <button class="sparkle-button">
                                <span class="spark"></span>
                                
                                <span class="backdrop"></span>
                                <svg class="sparkle" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.187 8.096L15 5.25L15.813 8.096C16.0231 8.83114 16.4171 9.50062 16.9577 10.0413C17.4984 10.5819 18.1679 10.9759 18.903 11.186L21.75 12L18.904 12.813C18.1689 13.0231 17.4994 13.4171 16.9587 13.9577C16.4181 14.4984 16.0241 15.1679 15.814 15.903L15 18.75L14.187 15.904C13.9769 15.1689 13.5829 14.4994 13.0423 13.9587C12.5016 13.4181 11.8321 13.0241 11.097 12.814L8.25 12L11.096 11.187C11.8311 10.9769 12.5006 10.5829 13.0413 10.0423C13.5819 9.50162 13.9759 8.83214 14.186 8.097L14.187 8.096Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6 14.25L5.741 15.285C5.59267 15.8785 5.28579 16.4206 4.85319 16.8532C4.42059 17.2858 3.87853 17.5927 3.285 17.741L2.25 18L3.285 18.259C3.87853 18.4073 4.42059 18.7142 4.85319 19.1468C5.28579 19.5794 5.59267 20.1215 5.741 20.715L6 21.75L6.259 20.715C6.40725 20.1216 6.71398 19.5796 7.14639 19.147C7.5788 18.7144 8.12065 18.4075 8.714 18.259L9.75 18L8.714 17.741C8.12065 17.5925 7.5788 17.2856 7.14639 16.853C6.71398 16.4204 6.40725 15.8784 6.259 15.285L6 14.25Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.5 4L6.303 4.5915C6.24777 4.75718 6.15472 4.90774 6.03123 5.03123C5.90774 5.15472 5.75718 5.24777 5.5915 5.303L5 5.5L5.5915 5.697C5.75718 5.75223 5.90774 5.84528 6.03123 5.96877C6.15472 6.09226 6.24777 6.24282 6.303 6.4085L6.5 7L6.697 6.4085C6.75223 6.24282 6.84528 6.09226 6.96877 5.96877C7.09226 5.84528 7.24282 5.75223 7.4085 5.697L8 5.5L7.4085 5.303C7.24282 5.24777 7.09226 5.15472 6.96877 5.03123C6.84528 4.90774 6.75223 4.75718 6.697 4.5915L6.5 4Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span class="text">Generate</span>
                                </button>
                                <div class="bodydrop"></div>
                                <span aria-hidden="true" class="particle-pen">
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><svg class="particle" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.937 3.846L7.75 1L8.563 3.846C8.77313 4.58114 9.1671 5.25062 9.70774 5.79126C10.2484 6.3319 10.9179 6.72587 11.653 6.936L14.5 7.75L11.654 8.563C10.9189 8.77313 10.2494 9.1671 9.70874 9.70774C9.1681 10.2484 8.77413 10.9179 8.564 11.653L7.75 14.5L6.937 11.654C6.72687 10.9189 6.3329 10.2494 5.79226 9.70874C5.25162 9.1681 4.58214 8.77413 3.847 8.564L1 7.75L3.846 6.937C4.58114 6.72687 5.25062 6.3329 5.79126 5.79226C6.3319 5.25162 6.72587 4.58214 6.936 3.847L6.937 3.846Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="second_part">
                <div class="container">
                    <form @submit.prevent="submitForm">
                        <header>
                            <div class="inputs">
                                <input type="text" class="input" required v-model="form.title">
                            </div>
                            <div class="buttons">
                                <button type="submit" class="register_button" title="Register">Save<i class="fa-solid fa-floppy-disk ml-2"></i></button>
                                <p title="As PDF" @click="saveAsPDF" class="register_button">PDF<i class="fa-solid fa-download ml-2"></i></p>
                                <p title="Copy text to clipboard" @click="copyMessage" class="register_button"><i class="fa-solid fa-copy"></i></p>
                            </div>
                        </header>
                        <body>
                            <div id="app" class="text_editor_vue" :class="language=='Arabic'? 'invers_direction':''">
                                <ckeditor :editor="editor" v-model="messages_show"></ckeditor>
                            </div>
                            <div v-if="isAssistantTyping" class="isAssistantTyping" ref="messagesContainer">
                                <svg xmlns="http://www.w3.org/2000/svg" height="200px" width="200px" viewBox="0 0 200 200" class="pencil">
                                    <defs>
                                        <clipPath id="pencil-eraser">
                                            <rect height="30" width="30" ry="5" rx="5"></rect>
                                        </clipPath>
                                    </defs>
                                    <circle transform="rotate(-113,100,100)" stroke-linecap="round" stroke-dashoffset="439.82" stroke-dasharray="439.82 439.82" stroke-width="2" stroke="currentColor" fill="none" r="70" class="pencil__stroke"></circle>
                                    <g transform="translate(100,100)" class="pencil__rotate">
                                        <g fill="none">
                                            <circle transform="rotate(-90)" stroke-dashoffset="402" stroke-dasharray="402.12 402.12" stroke-width="30" stroke="hsl(223,90%,50%)" r="64" class="pencil__body1"></circle>
                                            <circle transform="rotate(-90)" stroke-dashoffset="465" stroke-dasharray="464.96 464.96" stroke-width="10" stroke="hsl(223,90%,60%)" r="74" class="pencil__body2"></circle>
                                            <circle transform="rotate(-90)" stroke-dashoffset="339" stroke-dasharray="339.29 339.29" stroke-width="10" stroke="hsl(223,90%,40%)" r="54" class="pencil__body3"></circle>
                                        </g>
                                        <g transform="rotate(-90) translate(49,0)" class="pencil__eraser">
                                            <g class="pencil__eraser-skew">
                                                <rect height="30" width="30" ry="5" rx="5" fill="hsl(223,90%,70%)"></rect>
                                                <rect clip-path="url(#pencil-eraser)" height="30" width="5" fill="hsl(223,90%,60%)"></rect>
                                                <rect height="20" width="30" fill="hsl(223,10%,90%)"></rect>
                                                <rect height="20" width="15" fill="hsl(223,10%,70%)"></rect>
                                                <rect height="20" width="5" fill="hsl(223,10%,80%)"></rect>
                                                <rect height="2" width="30" y="6" fill="hsla(223,10%,10%,0.2)"></rect>
                                                <rect height="2" width="30" y="13" fill="hsla(223,10%,10%,0.2)"></rect>
                                            </g>
                                        </g>
                                        <g transform="rotate(-90) translate(49,-30)" class="pencil__point">
                                            <polygon points="15 0,30 30,0 30" fill="hsl(33,90%,70%)"></polygon>
                                            <polygon points="15 0,6 30,0 30" fill="hsl(33,90%,50%)"></polygon>
                                            <polygon points="15 0,20 10,10 10" fill="hsl(223,10%,10%)"></polygon>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </body>
                    </form>
                </div>
            </div>

            <!-- popup -->
            <div class="limit_frame" v-if="edit_faild_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"></div>
                        <div class="exite" id="exit_popup" @click="edit_faild_frame_fun()"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="edit_faild_db" class="body_fram">
                        <div class="small_panel">
                            <div class="form-group">
                                <label for="name" class="col-form-label mb-2">Title</label>
                                <input type="text" class="form-control" id="name" v-model="edit_faild_vars.title" required :error="edit_faild_vars.errors.title">
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label mb-2">Type</label>
                                <select class="form-control" id="name" v-model="edit_faild_vars.type" required>
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                </select>
                            </div>
                        </div>
                        <div class="save">
                            <button type="submit">
                                save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="limit_frame" v-if="add_faild_frame">
                <div class="limit_panel">
                    <div class="header">
                        <div class="logo"></div>
                        <div class="exite" id="exit_popup" @click="add_faild_frame_fun()"><i class="fa-sharp fa-solid fa-circle-xmark"></i></div>
                    </div>
                    <form @submit.prevent="add_faild_db" class="body_fram">
                        <div class="small_panel">
                            <div class="form-group">
                                <label for="name" class="col-form-label mb-2">Title</label>
                                <input type="text" class="form-control" id="name" v-model="add_faild_vars.title" required :error="add_faild_vars.errors.title">
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label mb-2">Type</label>
                                <select class="form-control" id="name" v-model="add_faild_vars.type" required>
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                </select>
                            </div>
                        </div>
                        <div class="save">
                            <button type="submit">
                                save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="popup_favorit_add" v-if="popup_tokens">
                <div class="notificationCard">
                    <i class="fa-solid fa-xmark"></i>
                    <p class="notificationHeading">you reached your max limit of words in your plan , please by other plan</p>
                    <div class="buttonContainer">
                        <Link class="AllowBtn flex justify-center items-center" :href="route('Subscription')">OK</Link>
                    </div>
                </div>
            </div>
            <div class="popup_favorit_add" v-if="popup_error_generate">
                <div class="notificationCard">
                    <i class="fa-solid fa-xmark"></i>
                    <p class="notificationHeading">An error occurred, make sure your connection is stable and try again</p>
                    <div class="buttonContainer">
                        <button class="AllowBtn flex justify-center items-center" @click="popup_error_generate_fun()">ok</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3'

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import CKEditor from "@ckeditor/ckeditor5-vue"

    import { jsPDF } from "jspdf";


    const props = defineProps({
        posts: Array,
        pages: Object,
        feilds: Object,
        token_max: Object,
        token_usage: Object,
        feilds_custom: Object,
    })

</script>

<script>
export default {
    name: 'app',
    components: {
        Head,
        Link,
        ckeditor: CKEditor.component
    },

    data() {
        return {
            countToken : null,
            curentToken : 0,
            popup_tokens : false,
            popup_error_generate :  false,
            open_remove_buttons: null,
            open_edit_buttons: null,
            edit_feild_checkbox: false,

            fields_input : [],
            fields_input_custom : [],
            add_faild_frame: false,
            add_faild_vars: this.$inertia.form({
                title: null,
                type: null,
            }),
            edit_faild_frame: false,
            edit_faild_vars: this.$inertia.form({
                id_feild: null,
                title: null,
                type: null,
            }),
            edit_faild_button: false,

            concatinate_inputs: null,

            language: 'English',
            Creativity: 'Original',
            Tone_of_Voice: 'Professional',
            Number_of_Results: 1,
            Estimated_Result_Length: 400,

            //chat
            userName: 'User', 
            userQuestion: null,

            editor: ClassicEditor,
            messages_show: '<p>Your text will be show here ...</p>',
            messages: [],
            isAssistantTyping: false,

            form: this.$inertia.form({
                title: 'new text',
                language: null,
                content: null,
                htmlContent: null
            }),
            text_content: null,
        }
    },
    mounted(){
        this.generate_tab()
        this.checkToken()
    },
    methods: {
        open_remove_buttons_fun(){
            this.open_edit_buttons = false;
            this.open_remove_buttons = true;
        },
        open_edit_buttons_fun(){
            this.open_edit_buttons = true;
            this.open_remove_buttons = false;
        },
        add_faild_frame_fun(){
            this.add_faild_frame?
                this.add_faild_frame = false:
                this.add_faild_frame = true;
        },
        edit_faild_frame_fun(id_feild,title,type){
            this.edit_faild_frame?
                this.edit_faild_frame = false:
                [
                    this.edit_faild_vars.id_feild = id_feild,
                    this.edit_faild_vars.title = title,
                    this.edit_faild_vars.type = type,
                    this.edit_faild_frame = true,
                ]
        },
        popup_tokens_over(){
            this.popup_tokens?
                this.popup_tokens = false:
                this.popup_tokens = true;
        },
        popup_error_generate_fun(){
            this.popup_error_generate?
                this.popup_error_generate = false:
                this.popup_error_generate = true;
        },
        add_faild_db(){
            this.add_faild_vars.get(`/ai_tools_template/${this.pages.id}/add_feild`, {
                onSuccess: () => {
                this.add_faild_frame = false;
                this.add_faild_vars.reset();
                },
            });
        },
        edit_faild_db(){
            this.edit_faild_vars.get(`/ai_tools_template/${this.edit_faild_vars.id_feild}/edit_feild`, {
                onSuccess: () => {
                this.edit_faild_frame = false;
                this.edit_faild_vars.reset();
                },
            });
        },
        edit_faild_button_fun(){
            this.edit_faild_button?
                [
                    this.open_edit_buttons = false,
                    this.open_remove_buttons = false,
                    this.edit_faild_button=false,
                ]:
                this.edit_faild_button=true;
        },

        generate_tab(){
            this.fields_input = [];
            for (let i = 0; i < this.feilds.length; i++) {
                this.fields_input.push({
                    title: this.feilds[i].title,
                    content: '' ,
                    type: this.feilds[i].type ,
                });
            }
            this.fields_input_custom = [];
            for (let i = 0; i < this.feilds_custom.length; i++) {
                this.fields_input_custom.push({
                    id: this.feilds_custom[i].id,
                    title: this.feilds_custom[i].title,
                    content: '' ,
                    type: this.feilds_custom[i].type ,
                });
            }
        },
        checkToken(){
            if(this.token_usage){
                this.countToken = this.token_usage.usage_words;

                if(this.$page.props.auth.user.special_user)
                    this.countToken = this.token_usage.usage_words;

                else if(this.$page.props.auth.user.payment)
                    this.curentToken = this.token_max.max_word;

                else
                    this.curentToken = 1000;
            }
        },
        concatenateFields() {
            this.concatinate_inputs = this.pages.prompte,' with ';
            for (let i = 0; i < this.fields_input.length; i++) {
                if(i == 0)
                    this.concatinate_inputs +=',I need it about '+ this.fields_input[i].title +' = '+ this.fields_input[i].content;
                else
                    this.concatinate_inputs += ' and the ' + this.fields_input[i].title +' = '+ this.fields_input[i].content;
            }
            for (let i = 0; i < this.fields_input_custom.length; i++) {
                this.concatinate_inputs += ' and the ' + this.fields_input_custom[i].title +' = '+ this.fields_input_custom[i].content;
            }
            this.concatinate_inputs = this.concatinate_inputs+' With language '+this.language+' and '+this.Creativity+', the Tone of Voice is also '+this.Tone_of_Voice+', the Number of Results is '+this.Number_of_Results+' result(s), and the Estimated Result Length is '+this.Estimated_Result_Length+' line(s)';
        },

        addFavorit_text(tool_id) {
            this.$inertia.post(`/ai_tools_list/${tool_id}/add_favorit`);
        },

        //chat
        sendMessage() {
            this.concatinate_inputs = null;
            this.concatenateFields();
            this.userQuestion = this.concatinate_inputs
            this.messages.push({ role: 'user', name: this.userName, content: this.userQuestion});

            if(this.$page.props.auth.user.special_user)
                this.getAnswer();
            else if(this.countToken <= this.curentToken)
                this.getAnswer();
            else
                this.popup_tokens_over();
        },
        getAnswer() {
            this.messages_show = '';
            this.isAssistantTyping = true;
            axios.post(`/ai_tools_template/generate`, {
                messages: this.messages,
            })
            .then(response => {
                this.countToken_fun(this.pages.id,response.data.usage.total_tokens)
                this.isAssistantTyping = false;
                const answer = response.data.choices[0].message.content;
                this.text_content = answer;
                this.messages_show = answer;
                this.displayTypingAnimation(answer);
                setTimeout(() => {
                    assistantMessage.content = answer;
                }, answer.length * 50);
            })
            .catch(error => {
                this.popup_error_generate_fun();
                this.isAssistantTyping = false;
                console.error(error);
            });
        },
        countToken_fun(id_tool,tokens) {
            axios.post(`/ai_tools_template/${id_tool}/${tokens}/countToken`)
                .then(response => {
                    if (response.data.success) {
                        this.countToken = response.data.token_usage;
                    }
                })
                .catch(error => {
                console.error('Error liking comment:', error);
            });
        },
        //typing style 
        displayTypingAnimation(message) {
            let index = 0;
            const typingSpeed = 5;
            let fullMessage = message;

            const typingInterval = setInterval(() => {
                if (index < fullMessage.length) {
                    this.messages_show = fullMessage.slice(0, index + 1);
                    index++;
                } else {
                    clearInterval(typingInterval);
                }
            }, typingSpeed);
        },

        submitForm() {
            this.form.content = this.text_content;
            this.form.language = this.language;
            this.form.htmlContent = this.messages_show;
            this.form.post(`/document_data/${this.pages.id}/textsave`);
        },

        //save pdf
        saveAsPDF() {
            const doc = new jsPDF();
            const longText = this.text_content;
            const pageWidth = doc.internal.pageSize.getWidth();
            const margin = 20; 
            const textWidth = pageWidth - margin * 2;

            const lines = doc.splitTextToSize(longText, textWidth);

            doc.text(lines, margin, 20);

            doc.save("Ai-Toolbox-document.pdf");
        },
        //copy text
        async copyMessage() {
            try {
                await navigator.clipboard.writeText(this.text_content);
                alert('Message copied to clipboard!');
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        },

    },
    computed: {

    }
}
</script>