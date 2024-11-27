<template>
    <div class="bg_questions">
        <Head title="Questions" />
        <div class="first_part">
            <div class="description">
                <form @submit.prevent="save_question">
                    <div class="title">started</div>
                    <div class="typed">
                        <p>{{ typedText1 }}</p>
                        <div class="custom-select" @click="toggleDropdown1" @blur="closeDropdown1" tabindex="0">
                            <div class="select-trigger" v-if="showline1">{{ question_form.question1|| '______________'  }}</div>
                            <div class="options" v-if="isOpen1">
                                <div 
                                    class="option" 
                                    v-for="option in options1" 
                                    :key="option.value" 
                                    @click.stop="selectOption1(option)"
                                >
                                    {{ option.text }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="typed"  v-if="showlist2">
                        <p>{{ typedText2 }}</p>
                        <div class="custom-select" @click="toggleDropdown2" @blur="closeDropdown2" tabindex="0">
                            <div class="select-trigger" v-if="showline2">{{ question_form.question2 || '______________' }}</div>
                            <div class="options" v-if="isOpen2">
                                <div 
                                    class="option" 
                                    v-for="option in options2" 
                                    :key="option.value" 
                                    @click.stop="selectOption2(option)"
                                >
                                    {{ option.text }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="typed" v-if="showlist3">
                        <p>{{ typedText3 }}</p>
                        <div class="custom-select" @click="toggleDropdown3" @blur="closeDropdown3" tabindex="0">
                            <div class="select-trigger" v-if="showline3">{{ question_form.question3 || '____________________' }}</div>
                            <div class="options" v-if="isOpen3">
                                <div 
                                    class="option" 
                                    v-for="option in options3" 
                                    :key="option.value" 
                                    @click.stop="selectOption3(option)"
                                >
                                    {{ option.text }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <PrimaryButton v-if="question_form.question1 && question_form.question2 && question_form.question3" class="question_button" :class="{ 'opacity-25': question_form.processing }" :disabled="question_form.processing">
                            Let's go
                    </PrimaryButton>
                </form>
            </div>
            <Link :href="route('answer.skip')" method="post" class="skip">
                Skip for now
            </Link>
        </div>
        <div class="second_part">
            <div class="img">
                <img src="/icon/questions.png" alt="">
            </div>
        </div>
    </div>
</template>
<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
</script>
<script>
export default {
  data() {
    return {
        question_form: this.$inertia.form({
          question1: null,
          question2: null,
          question3: null,
        }),

        selected2: false,
        selected3: false,

        showlist1: true,
        showlist2: false,
        showlist3: false,

        showline1: false,
        showline2: false,
        showline3: false,

        typedText1: '', 
        typedText2: '', 
        typedText3: '', 

        typingSpeed: 100,
        originalText1: 'I am a ',
        originalText2: ',and ',
        originalText3: 'I want to use AI-Toolbox to ',
        isOpen1: false,
        options1: [
            { value: 'Developer', text: 'Software Developer' },
            { value: 'Data Scientist', text: 'Data Scientist and Analyst' },
            { value: 'Designer', text: 'Graphic Designer' },
            { value: 'Content Creator', text: 'Content Creator and Journalist' },
            { value: 'Busines Analyst', text: 'Busines Analyst and Strategist' },
            { value: 'Manager', text: 'HR Manager and Recruiter' },
            { value: 'Entrepreneur', text: 'Entrepreneur and Start-up Owner' },
            { value: 'Marketer', text: 'Marketer and Sale Professional' },
        ],
        isOpen2: false,
        options2: [
            { value: 'entreprise', text: 'entreprise' },
            { value: 'start-up', text: 'start-up' },
            { value: "I'm a freelancer", text: "I'm a freelancer" },
        ],
        isOpen3: false,
        options3: [
            { value: 'developement', text: 'software developement' },
            { value: 'Analyze Data', text: 'Analyze Data' },
            { value: 'Designer', text: 'Graphic Designer' },
            { value: 'Create Content', text: 'Create Content' },
            { value: 'Solve Problems', text: 'Solve Complex Problems' },
            { value: 'Business', text: 'Business Optimization Stay Ahead' },
            { value: 'Marketer', text: 'Marketer and Sale Professional' },

        ]
    };
  },
  mounted() {
    this.typeText();
  },
  methods: {
    typeText() {
      let i = 0;
      const interval = setInterval(() => {
        if (i < this.originalText1.length) {
          this.typedText1 += this.originalText1.charAt(i);
          i++;
        } else {
          clearInterval(interval);
          this.isOpen1 = true;
          this.showline1 = true;
        }
      }, this.typingSpeed);
    },
    typeText2() {
      let i = 0;
      const interval = setInterval(() => {
        if (i < this.originalText2.length) {
          this.typedText2 += this.originalText2.charAt(i);
          i++;
        } else {
          clearInterval(interval);
          this.isOpen2 = true;
          this.showline2 = true;
        }
      }, this.typingSpeed);
    },
    typeText3() {
      let i = 0;
      const interval = setInterval(() => {
        if (i < this.originalText3.length) {
          this.typedText3 += this.originalText3.charAt(i);
          i++;
        } else {
          clearInterval(interval);
          this.isOpen3 = true;
          this.showline3 = true;
        }
      }, this.typingSpeed);
    },

    toggleDropdown1() {
        this.isOpen1?
            this.isOpen1 = false:
            [
                this.isOpen1 = true,
                this.isOpen2 = false,
                this.isOpen3 = false,
            ];
    },
    selectOption1(option1) {
      this.question_form.question1 = option1.text;
      this.isOpen1 = false;
      this.showlist2 = true;
      if(!this.selected2)
        this.typeText2();
        this.selected2=true;
    },
    closeDropdown1() {
      this.isOpen1 = false;
    },

    toggleDropdown2() {
        this.isOpen2?
            this.isOpen2 = false:
            [
                this.isOpen2 = true,
                this.isOpen1 = false,
                this.isOpen3 = false,
            ];
    },
    selectOption2(option2) {
      this.question_form.question2 = option2.text;
      this.isOpen2 = false;
      this.showlist3 = true;
      if(!this.selected3)
        this.typeText3()
        this.selected3=true;
    },
    closeDropdown2() {
      this.isOpen2 = false;
    },

    toggleDropdown3() {
        this.isOpen3?
            this.isOpen3 = false:
            [
                this.isOpen3 = true,
                this.isOpen1 = false,
                this.isOpen2 = false,
            ];
    },
    selectOption3(option3) {
      this.question_form.question3 = option3.text;
      this.isOpen3 = false;
    },
    closeDropdown3() {
      this.isOpen3 = false;
    },

    //
    save_question() {
          this.question_form.get(`/questions/save`);
      },
  },
};
</script>
