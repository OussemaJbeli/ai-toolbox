<template>
    <Head title="AI-Tool" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight page_title">
                <i class="fa-solid fa-star"></i>
                /AI-Voice</h2>
        </template>
        <div class="Text_To_Speech_template" v-if="pages.title == 'Text To Speech'">
            <form class="first_part">
                <div class="title">
                    <span>Text To Speech</span>
                    <div class="words_balence" v-if="$page.props.auth.user.special_user">
                        Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / Unlimited image
                    </div>
                    <div class="words_balence" v-else-if="$page.props.auth.user.payment">
                        Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / {{ curentToken }} token
                    </div>
                    <div class="words_balence" v-else>
                        Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / {{ curentToken }} token
                    </div>
                </div>
                <div class="description">Transform the text to speech with any carecter you like.</div>
                <div class="advance_option adv_op_1">
                    <div class="card">
                        <p>Language</p>
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
                    <div class="card">
                        <label for="characters_sayas">Characters</label>
                        <select class="form-select" v-model="Character_selected">
                            <option v-for="char in characters" :value="char">{{char.VoiceName}}</option>
                        </select>
                    </div>
                </div>
                <div class="input_text">
                    <div class="user " v-if="Character_selected.Gender == 'Male'"><i class="fa-solid fa-person text-blue-600"></i><span>{{Character_selected.VoiceName}}</span></div>
                    <div class="user" v-if="Character_selected.Gender == 'Female'"><i class="fa-solid fa-person-dress text-pink-600"></i><span>{{Character_selected.VoiceName}}</span></div>
                    <textarea v-model="text_to_speech" cols="30" rows="10" class="input" required placeholder="Type your text here ... "></textarea>
                    <div class="button">
                        <div class="loading" v-if="isAssistantTyping">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="sp" @click="getVoice()" v-else>
                                <button class="sparkle-button">
                                <span class="spark"></span>
                                
                                <span class="backdrop"></span>
                                <svg class="sparkle" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.187 8.096L15 5.25L15.813 8.096C16.0231 8.83114 16.4171 9.50062 16.9577 10.0413C17.4984 10.5819 18.1679 10.9759 18.903 11.186L21.75 12L18.904 12.813C18.1689 13.0231 17.4994 13.4171 16.9587 13.9577C16.4181 14.4984 16.0241 15.1679 15.814 15.903L15 18.75L14.187 15.904C13.9769 15.1689 13.5829 14.4994 13.0423 13.9587C12.5016 13.4181 11.8321 13.0241 11.097 12.814L8.25 12L11.096 11.187C11.8311 10.9769 12.5006 10.5829 13.0413 10.0423C13.5819 9.50162 13.9759 8.83214 14.186 8.097L14.187 8.096Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6 14.25L5.741 15.285C5.59267 15.8785 5.28579 16.4206 4.85319 16.8532C4.42059 17.2858 3.87853 17.5927 3.285 17.741L2.25 18L3.285 18.259C3.87853 18.4073 4.42059 18.7142 4.85319 19.1468C5.28579 19.5794 5.59267 20.1215 5.741 20.715L6 21.75L6.259 20.715C6.40725 20.1216 6.71398 19.5796 7.14639 19.147C7.5788 18.7144 8.12065 18.4075 8.714 18.259L9.75 18L8.714 17.741C8.12065 17.5925 7.5788 17.2856 7.14639 16.853C6.71398 16.4204 6.40725 15.8784 6.259 15.285L6 14.25Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.5 4L6.303 4.5915C6.24777 4.75718 6.15472 4.90774 6.03123 5.03123C5.90774 5.15472 5.75718 5.24777 5.5915 5.303L5 5.5L5.5915 5.697C5.75718 5.75223 5.90774 5.84528 6.03123 5.96877C6.15472 6.09226 6.24777 6.24282 6.303 6.4085L6.5 7L6.697 6.4085C6.75223 6.24282 6.84528 6.09226 6.96877 5.96877C7.09226 5.84528 7.24282 5.75223 7.4085 5.697L8 5.5L7.4085 5.303C7.24282 5.24777 7.09226 5.15472 6.96877 5.03123C6.84528 4.90774 6.75223 4.75718 6.697 4.5915L6.5 4Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span class="text">Generate Voice</span>
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
            <div class="second_part" v-if="audioSource || isAssistantTyping">
                <div class="loader" v-if="isAssistantTyping">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
                <av-bars v-if="audioSource && !isAssistantTyping"
                    :caps-color="$page.props.auth.user.filter"
                    :bar-color="$page.props.auth.user.filter"
                    :caps-height="2"
                    :src="audioSource"
                ></av-bars>
            </div>
            <!-- document -->
            <div class="frame_original pt-10 pb-4 ">
                <div class="w-100 mt-2 mb-4 flex flex-row items-center justify-start">
                    <span class="h3">List Documents</span>
                </div>
                <div class="table_frame">
                    <DataTable class="table_edit DataTable1">
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="pb-4 pt-6 px-6 text-start">date</th>
                                <th class="pb-4 pt-6 px-6 text-start">language</th>
                                <th class="pb-4 pt-6 px-6 text-start">voice</th>
                                <th class="pb-4 pt-6 px-6 text-start">gender</th>
                                <th class="pb-4 pt-6 px-6 text-start"><i class="fa-solid fa-music"></i></th>
                                <th class="pb-4 pt-6 px-6 text-start">format</th>
                                <th class="pb-4 pt-6 px-6 text-start">chars</th>
                                <th class="pb-4 pt-6 px-6 text-start">delete</th>
                            </tr>
                        </thead>
                        <tbody class="text-right">
                            <tr v-for="(voice,index) in voices" :key="index">
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.created_at }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.language }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.VoiceName }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.Gender }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    <label :for="'audioPlayer' + index" @click="playOrPauseAudio(index)">
                                        <i class="fa-solid fa-play"></i>
                                    </label>
                                    <audio :id="'audioPlayer' + index" :ref="'audio' + index" :src="voice.voice_path"></audio>
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    mp3
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start">
                                    {{ voice.chars }}
                                </td>
                                <td class="pb-4 pt-6 px-6 border-t text-start  ">
                                    <Link :href="``">
                                        <i class="fa-solid fa-trash text-red-500 mr-2"></i>delete
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </DataTable>
                </div>
            </div>
        </div>
        <div class="Speech_to_Text_template" v-else>
            <div class="first_part">
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
                            <input type="checkbox"  @click="addFavorit(pages.id)" :checked="pages.id === pages.id_tool">
                            <svg height="24px" id="Layer_1" version="1.2" viewBox="0 0 24 24" width="24px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><path d="M9.362,9.158c0,0-3.16,0.35-5.268,0.584c-0.19,0.023-0.358,0.15-0.421,0.343s0,0.394,0.14,0.521    c1.566,1.429,3.919,3.569,3.919,3.569c-0.002,0-0.646,3.113-1.074,5.19c-0.036,0.188,0.032,0.387,0.196,0.506    c0.163,0.119,0.373,0.121,0.538,0.028c1.844-1.048,4.606-2.624,4.606-2.624s2.763,1.576,4.604,2.625    c0.168,0.092,0.378,0.09,0.541-0.029c0.164-0.119,0.232-0.318,0.195-0.505c-0.428-2.078-1.071-5.191-1.071-5.191    s2.353-2.14,3.919-3.566c0.14-0.131,0.202-0.332,0.14-0.524s-0.23-0.319-0.42-0.341c-2.108-0.236-5.269-0.586-5.269-0.586    s-1.31-2.898-2.183-4.83c-0.082-0.173-0.254-0.294-0.456-0.294s-0.375,0.122-0.453,0.294C10.671,6.26,9.362,9.158,9.362,9.158z"></path></g></g></svg>
                        </label>
                    </div>
                </div>
                <div class="description">
                    <p class="description">{{pages.description}}</p>
                </div>
                <div class="words_balence" v-if="$page.props.auth.user.special_user">
                    Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / Unlimited
                </div>
                <div class="words_balence" v-else-if="$page.props.auth.user.payment">
                    Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / {{ curentToken }}
                </div>
                <div class="words_balence" v-else>
                    Your Balance <span v-if="countToken">{{countToken}}</span><span v-else>0</span> / {{ curentToken }}
                </div>
                <div class="inputs">
                    <label for="">Upload an Audio File (mp3, mp4, mpeg, mpga, m4a, wav, and webm)(Max: 25Mb)</label>
                    <FileInput
                        required
                        v-model="audioFILE"
                        class="file_shoser"
                        type="file"
                        accept="audio/*"
                        @change="handleFileChange"
                    />
                    <p class="text-red-700 fileSizeError" v-if="fileSizeError == false">the max size is 25Mb</p>
                </div>
                <div class="generate_butt">
                    <div class="button">
                        <div class="sp" @click="getText()">
                            <button class="sparkle-button">
                            <span class="spark"></span>
                            
                            <span class="backdrop"></span>
                            <svg class="sparkle" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.187 8.096L15 5.25L15.813 8.096C16.0231 8.83114 16.4171 9.50062 16.9577 10.0413C17.4984 10.5819 18.1679 10.9759 18.903 11.186L21.75 12L18.904 12.813C18.1689 13.0231 17.4994 13.4171 16.9587 13.9577C16.4181 14.4984 16.0241 15.1679 15.814 15.903L15 18.75L14.187 15.904C13.9769 15.1689 13.5829 14.4994 13.0423 13.9587C12.5016 13.4181 11.8321 13.0241 11.097 12.814L8.25 12L11.096 11.187C11.8311 10.9769 12.5006 10.5829 13.0413 10.0423C13.5819 9.50162 13.9759 8.83214 14.186 8.097L14.187 8.096Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M6 14.25L5.741 15.285C5.59267 15.8785 5.28579 16.4206 4.85319 16.8532C4.42059 17.2858 3.87853 17.5927 3.285 17.741L2.25 18L3.285 18.259C3.87853 18.4073 4.42059 18.7142 4.85319 19.1468C5.28579 19.5794 5.59267 20.1215 5.741 20.715L6 21.75L6.259 20.715C6.40725 20.1216 6.71398 19.5796 7.14639 19.147C7.5788 18.7144 8.12065 18.4075 8.714 18.259L9.75 18L8.714 17.741C8.12065 17.5925 7.5788 17.2856 7.14639 16.853C6.71398 16.4204 6.40725 15.8784 6.259 15.285L6 14.25Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M6.5 4L6.303 4.5915C6.24777 4.75718 6.15472 4.90774 6.03123 5.03123C5.90774 5.15472 5.75718 5.24777 5.5915 5.303L5 5.5L5.5915 5.697C5.75718 5.75223 5.90774 5.84528 6.03123 5.96877C6.15472 6.09226 6.24777 6.24282 6.303 6.4085L6.5 7L6.697 6.4085C6.75223 6.24282 6.84528 6.09226 6.96877 5.96877C7.09226 5.84528 7.24282 5.75223 7.4085 5.697L8 5.5L7.4085 5.303C7.24282 5.24777 7.09226 5.15472 6.96877 5.03123C6.84528 4.90774 6.75223 4.75718 6.697 4.5915L6.5 4Z" fill="black" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span class="text">Generate Text</span>
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
                            <div class="pregenerate">
                                <div class="loader" v-if="uploading"></div>
                                <div class="typewriter" v-if="isAssistantTyping">
                                    <div class="slide"><i></i></div>
                                    <div class="paper"></div>
                                    <div class="keyboard"></div>
                                </div>
                                <div class="title" v-if="loader_title">{{ loader_title }}</div>
                            </div>
                            <div id="app" class="text_editor_vue">
                                <ckeditor :editor="editor" v-model="transcript_text"></ckeditor>
                            </div>
                        </body>
                    </form>
                </div>
            </div>
        </div>
        <!-- popup -->
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
                <p class="notificationHeading">An error occurred, make sure your connection is stable and try again, make sure the audio doesn't have any music</p>
                <div class="buttonContainer">
                    <button class="AllowBtn flex justify-center items-center" @click="popup_error_generate_fun()">ok</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FileInput from "@/Components/FileInput.vue";
import { Head , Link} from '@inertiajs/vue3';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from "@ckeditor/ckeditor5-vue"

import { jsPDF } from "jspdf";
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);

</script>

<script>
export default {
    name: 'App',
    components: {
        Head,
        Link,
        DataTable,
        ckeditor: CKEditor.component,
    },
    props: {
        pages: Object,
        Voice_tokens: Object,
        voices: Object,
    },

    data() {
        return {
            countToken : null,
            curentToken : 0,

            popup_tokens : false,
            popup_error_generate :  false,
            messages_show : false,

            isAssistantTyping : false,
            uploading : false,
            loader_title : null,

            fileSizeError: true,

            openAdvenceOption: false,
            Character_selected: {VoiceName: "Adam", Gender: "Male", Description: "Deep", UseCase: "Narration", Accent: "American English", VoiceId: "pNInz6obpgDQGcFmaJgB"},
            audioFILE: '',
            language: 'English',
            text_to_speech:null,
            audioSource:null,

            characters : [
                {  VoiceName: "Adam", Gender: "Male", Description: "Deep", UseCase: "Narration", Accent: "American English", VoiceId: "pNInz6obpgDQGcFmaJgB" },
                {  VoiceName: "Charlie", Gender: "Male", Description: "Casual", UseCase: "Conversational", Accent: "Australian English", VoiceId: "IKne3meq5aSn9XLyUdCD" },
                {  VoiceName: "Clyde", Gender: "Male", Description: "War veteran", UseCase: "Video games", Accent: "American English", VoiceId: "2EiwWnXFnvU5JabPnv8n" },
                {  VoiceName: "Dorothy", Gender: "Female", Description: "Pleasant", UseCase: "Children’s stories", Accent: "British English", VoiceId: "ThT5KcBeYPX3keUQqHPh" },
                {  VoiceName: "Freya", Gender: "Female", Description: "Overhyped", UseCase: "Video games", Accent: "American English", VoiceId: "jsCqWAovK2LkecY7zXl4" },
                {  VoiceName: "Gigi", Gender: "Female", Description: "Childlish", UseCase: "Animation", Accent: "American English", VoiceId: "jBpfuIE2acCO8z3wKNLl" },
                {  VoiceName: "Harry", Gender: "Male", Description: "Anxious", UseCase: "Video games", Accent: "American English", VoiceId: "SOYHLrjzK2X1ezoPC6cr" },
                {  VoiceName: "James", Gender: "Male", Description: "Calm", UseCase: "News", Accent: "Australian English", VoiceId: "ZQe5CZNOzWyzPSCn5a3c" },
                {  VoiceName: "Lily", Gender: "Female", Description: "Raspy", UseCase: "Narration", Accent: "British English", VoiceId: "pFZP5JQG7iQjIQuC4Bku" },
                {  VoiceName: "Rachel", Gender: "Female", Description: "Calm", UseCase: "Narration", Accent: "American English", VoiceId: "21m00Tcm4TlvDq8ikWAM" },
                {  VoiceName: "Glinda", Gender: "Female", Description: "Witch", UseCase: "Video games", Accent: "Mexican Spanish", VoiceId: "z9fAnlkpzviPz146aGWa" },
                {  VoiceName: "Grace", Gender: "Female", Description: "gentle", UseCase: "Audiobook", Accent: "Mexican Spanish", VoiceId: "oWAxZDx7w5VEj9dCyTzz" },
                {  VoiceName: "Matilda", Gender: "Female", Description: "Warm", UseCase: "Audiobook", Accent: "Chilean Spanish", VoiceId: "XrExE9yKIg1WjnnlVkGX" },
                {  VoiceName: "Sarah", Gender: "Female", Description: "Soft", UseCase: "News", Accent: "Germany German", VoiceId: "EXAVITQu4vr4xnSDxMaL" },
                {  VoiceName: "Serena", Gender: "Female", Description: "Pleasant", UseCase: "Interactive", Accent: "Germany German", VoiceId: "pMsXgVXv3BLzUgSXRplE" },
                {  VoiceName: "Antoni", Gender: "Male", Description: "Well-rounded", UseCase: "Narration", Accent: "Canadian French", VoiceId: "ErXwobaYiN019PkySvjV" },
                {  VoiceName: "Arnold", Gender: "Male", Description: "Crisp", UseCase: "Narration", Accent: "Canadian French", VoiceId: "VR6AewLTigWG4xSOukaG" },
                {  VoiceName: "Bill", Gender: "Male", Description: "Strong", UseCase: "documentary", Accent: "Canadian French", VoiceId: "pqHfZKP75CvOlQylNhV4" },
                {  VoiceName: "George", Gender: "Male", Description: "Raspy", UseCase: "Narration", Accent: "Canadian French", VoiceId: "JBFqnCBsd6RMkjVDRZzb" },
                {  VoiceName: "Charlotte", Gender: "Female", Description: "Seductive", UseCase: "Video games", Accent: "Canadian French", VoiceId: "XB0fDUnXU5powFXDhCwa" },
                {  VoiceName: "Domi", Gender: "Female", Description: "Strong", UseCase: "Narration", Accent: "Canadian French", VoiceId: "AZnzlk1XvdvUeBnXmlld" },
            ],

            audioFile: null,
            transcription: null,
            transcript_text: '',
            text_content: '',
            editor: ClassicEditor,
            form: this.$inertia.form({
                title: 'new text',
                language: 'voice cover',
                content: null,
                htmlContent: null
            }),
        }
    },
    mounted(){
        this.checkToken()
    },
    methods: {
        playOrPauseAudio(index) {
            const audio = this.$refs['audio' + index][0];
            if (audio.paused)
                audio.play();
            else 
                audio.pause();
        },
        checkToken(){
            if(this.Voice_tokens[0]){
                this.countToken = this.Voice_tokens[0].current_minuts;

                if(this.$page.props.auth.user.special_user)
                    this.countToken = this.Voice_tokens[0].current_minuts;

                else if(this.$page.props.auth.user.payment)
                    this.curentToken = this.Voice_tokens[0].max_minute;

                else
                    this.curentToken = 1000;
            }
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

        getText() {
            this.transcript_text = '';
            this.text_content = '';
            this.loader_title = 'uploading the audio, please wait ...'
            this.uploading = true;
            let formData = new FormData();
            formData.append('audio', this.audioFILE);
            
            axios.post('/ai_tools_template/generateSpeechToText', formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                this.loader_title = 'audio analysis ...'
                this.isAssistantTyping = true;
                this.uploading = false;
                this.pollForTranscription(response.data.transcript_id);
            }).catch(error => {
                console.error("There was an error uploading the file", error);
                this.uploading = false;
                this.isAssistantTyping = false;
                this.popup_error_generate_fun();
                this.loader_title = null;
            });
        },
        pollForTranscription(transcriptId) {

            axios.post('/ai_tools_template/getTranscriptionResult', { transcript_id: transcriptId , id_tool: this.pages.id })
                .then(response => {
                    if (response.data.status && response.data.status !== 'completed') {
                        setTimeout(() => this.pollForTranscription(transcriptId), 5000); // Poll every 5 seconds
                    } else if (response.data.transcription) {
                        this.isAssistantTyping = false;
                        this.loader_title = null;
                        const answer = response.data.transcription;
                        this.displayTypingAnimation(answer);
                        this.text_content = answer;
                        this.transcript_text = answer;
                        this.countToken = response.data.tokencount;
                    }
                })
                .catch(error => {
                    console.error('Error polling for transcription:', error);
                    this.isAssistantTyping = false;
                    this.popup_error_generate_fun();
                    this.loader_title = null;
                });
        },

        getVoice() {
            this.isAssistantTyping = true;
            const requestBody = {
                character: this.Character_selected,
                voice_id: this.Character_selected.VoiceId,
                id_tool: this.pages.id,
                text: this.text_to_speech,
                language: this.language,
                model_id: "eleven_multilingual_v2", 
            };
            axios.post(`/ai_tools_template/generateTextToSpeech`,requestBody)
            .then(response => {
                this.isAssistantTyping = false;
                this.audioSource = response.data.voicePath;
                this.countToken = response.data.tokencount;
            })
            .catch(error => {
                console.error(error);
                this.isAssistantTyping = false;
                this.popup_error_generate_fun();
            });
        },

        //typing style 
        displayTypingAnimation(message) {
            let index = 0;
            const typingSpeed = 5;
            let fullMessage = message;

            const typingInterval = setInterval(() => {
                if (index < fullMessage.length) {
                    this.transcript_text = fullMessage.slice(0, index + 1);
                    index++;
                } else {
                    clearInterval(typingInterval);
                }
            }, typingSpeed);
        },

        submitForm() {
            this.form.content = this.text_content;
            this.form.language = 'voice_cover';
            this.form.htmlContent = this.transcript_text;
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

        addFavorit(tool_id) {
            this.$inertia.post(`/ai_tools_list/${tool_id}/add_favorit`);
        },
        openAdvenceOption_fun(){
            this.openAdvenceOption?
                this.openAdvenceOption = false:
                this.openAdvenceOption = true;
            },
        handleFileChange(event) {
            const file = event.target.files[0];
            const maxSize = 25 * 1024 * 1024; 

            if (file && file.size > maxSize) {
                this.fileSizeError = false;
            } else {
                this.fileSizeError = true;
            }
        },

    },
    computed: {

    }
}
</script>
<style>
@import 'datatables.net-dt';
</style>