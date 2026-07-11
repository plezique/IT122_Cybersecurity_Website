/**
 * Interactive Quiz Engine — phishing and awareness quizzes.
 * Questions are passed as a JSON data attribute or loaded from data.js.
 */

const QUIZ_RESULTS_KEY = 'cybersafe-quiz-results';

function saveQuizResultLocal(result) {
    try {
        const existing = JSON.parse(localStorage.getItem(QUIZ_RESULTS_KEY) || '[]');
        existing.unshift({ ...result, date_taken: new Date().toISOString() });
        localStorage.setItem(QUIZ_RESULTS_KEY, JSON.stringify(existing.slice(0, 20)));
    } catch {
        // Ignore storage errors in private browsing mode.
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.quiz-engine').forEach((container) => {
        if (!container.dataset.questions) return;
        initQuiz(container);
    });
});

function initQuiz(container) {
    const questionArea = container.querySelector('.quiz-question-area');
    const progressBar = container.querySelector('.quiz-progress-bar');
    const questionEl = container.querySelector('.quiz-question-text');
    const optionsEl = container.querySelector('.quiz-options');
    const explanationEl = container.querySelector('.explanation-box');
    const nextBtn = container.querySelector('.quiz-next-btn');
    const resultEl = container.querySelector('.quiz-result');
    const retakeBtn = container.querySelector('.quiz-retake-btn');

    let questions = [];
    try {
        questions = JSON.parse(container.dataset.questions || '[]');
    } catch {
        showLoadError(container, questionArea);
        return;
    }

    const quizType = container.dataset.quizType || 'awareness';
    const moduleId = container.dataset.moduleId ? parseInt(container.dataset.moduleId, 10) : null;
    const saveUrl = container.dataset.saveUrl || '';
    const isLoggedIn = container.dataset.loggedIn === 'true';
    const radioName = `quiz-answer-${quizType}-${Math.random().toString(36).slice(2, 9)}`;

    if (!Array.isArray(questions) || questions.length === 0) {
        showLoadError(container, questionArea);
        return;
    }

    const state = {
        currentIndex: 0,
        score: 0,
        answered: false,
    };

    function normalizeAnswer(value) {
        return String(value ?? '').trim().toUpperCase();
    }

    function updateProgress() {
        const pct = (state.currentIndex / questions.length) * 100;
        progressBar.style.width = `${pct}%`;
    }

    function showLoadError(target, area) {
        if (area) area.style.display = 'none';
        const errorEl = document.createElement('div');
        errorEl.className = 'alert alert-error quiz-load-error';
        errorEl.textContent = 'Unable to load quiz. Please try again.';
        target.appendChild(errorEl);
    }

    function resetQuiz() {
        state.currentIndex = 0;
        state.score = 0;
        state.answered = false;

        questionArea.style.display = '';
        resultEl.style.display = 'none';
        explanationEl.style.display = 'none';
        explanationEl.innerHTML = '';
        nextBtn.style.display = 'none';
        optionsEl.innerHTML = '';

        showQuestion(0);
    }

    function showQuestion(index) {
        state.answered = false;
        const q = questions[index];

        questionEl.textContent = q.question_text || '';
        explanationEl.style.display = 'none';
        explanationEl.innerHTML = '';
        nextBtn.style.display = 'none';
        nextBtn.textContent = index < questions.length - 1 ? 'Next Question' : 'See Results';

        optionsEl.innerHTML = '';
        ['a', 'b', 'c', 'd'].forEach((letter) => {
            const optionKey = `option_${letter}`;
            const optionText = q[optionKey];
            if (!optionText) return;

            const li = document.createElement('li');
            const label = document.createElement('label');
            const radio = document.createElement('input');

            radio.type = 'radio';
            radio.name = radioName;
            radio.value = letter.toUpperCase();

            label.appendChild(radio);
            label.appendChild(document.createTextNode(optionText));

            radio.addEventListener('change', () => {
                if (state.answered) return;
                handleAnswer(letter.toUpperCase(), q);
            });

            li.appendChild(label);
            optionsEl.appendChild(li);
        });

        updateProgress();
    }

    function handleAnswer(selected, question) {
        if (state.answered) return;
        state.answered = true;

        const correct = normalizeAnswer(question.correct_answer);
        const normalizedSelected = normalizeAnswer(selected);
        const isCorrect = normalizedSelected === correct;

        if (isCorrect) state.score++;

        optionsEl.querySelectorAll('label').forEach((label) => {
            const letter = normalizeAnswer(label.querySelector('input').value);
            if (letter === correct) {
                label.classList.add('correct');
            } else if (letter === normalizedSelected) {
                label.classList.add('incorrect');
            }
            label.querySelector('input').disabled = true;
        });

        optionsEl.style.pointerEvents = 'none';

        const resultClass = isCorrect ? 'result-correct' : 'result-incorrect';
        const resultText = isCorrect ? 'Correct' : 'Incorrect';
        explanationEl.innerHTML =
            `<strong class="${resultClass}">${resultText}.</strong> ${question.explanation || ''}`;
        explanationEl.style.display = 'block';
        nextBtn.style.display = 'inline-flex';
    }

    function showResults() {
        questionArea.style.display = 'none';
        resultEl.style.display = 'block';
        progressBar.style.width = '100%';

        const pct = Math.round((state.score / questions.length) * 100);
        resultEl.querySelector('.score-value').textContent = `${state.score}/${questions.length}`;

        let level = '';
        let levelClass = '';
        if (quizType === 'awareness' || quizType === 'module') {
            if (pct < 50) {
                level = 'Beginner';
                levelClass = 'awareness-beginner';
            } else if (pct < 80) {
                level = 'Intermediate';
                levelClass = 'awareness-intermediate';
            } else {
                level = 'Advanced';
                levelClass = 'awareness-advanced';
            }

            const badge = resultEl.querySelector('.awareness-badge');
            if (badge) {
                badge.textContent = `${level} Awareness Level`;
                badge.className = `awareness-badge ${levelClass}`;
            }
        }

        resultEl.querySelector('.result-message').textContent =
            pct >= 80
                ? 'Excellent work! You have strong security awareness.'
                : pct >= 50
                    ? 'Good effort! Review the modules to strengthen weak areas.'
                    : 'Keep learning! Explore our modules to build your security knowledge.';

        if (isLoggedIn && saveUrl) {
            const payload = {
                quiz_type: quizType,
                score: state.score,
                total: questions.length,
                awareness_level: level || null,
            };
            if (moduleId) {
                payload.module_id = moduleId;
            }
            fetch(saveUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload),
            }).catch(() => {});
        }

        saveQuizResultLocal({
            quiz_type: quizType,
            score: state.score,
            total: questions.length,
            awareness_level: level || null,
            module_id: moduleId,
        });
    }

    nextBtn.addEventListener('click', () => {
        state.currentIndex++;
        optionsEl.style.pointerEvents = '';

        if (state.currentIndex < questions.length) {
            showQuestion(state.currentIndex);
        } else {
            showResults();
        }
    });

    if (retakeBtn) {
        retakeBtn.addEventListener('click', resetQuiz);
    }

    showQuestion(0);
}
