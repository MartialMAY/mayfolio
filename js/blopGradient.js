const wrapperElement = document.getElementById('wrapper');
const cursorElement = document.getElementById('cursor');

const cursor = {
	x: 0,
	y: 0,
	lazyX: 0,
	lazyY: 0,
	// Configure speed in a 0 to 1 range.
	lazySpeed: 0.05,

	highlightScale: 0,
	lazyHighlightScale: 0
}

const lerp = (x, y, t) => {
	return (1 - t) * x + t * y;
};

const onMouseEnter = () => {
	cursorElement.classList.remove('hidden');
	
	cursor.highlightScale = 1;
};

const onMouseLeave = () => {
	cursorElement.classList.add('hidden');
	
	cursor.highlightScale = 0;
};

const onMouseMove = (e) => {
	cursor.x = e.clientX;
	cursor.y = e.clientY;
};

const animate = () => {
	requestAnimationFrame(animate);
	
	cursor.lazyX = lerp(cursor.lazyX, cursor.x, cursor.lazySpeed);
	cursor.lazyY = lerp(cursor.lazyY, cursor.y, cursor.lazySpeed);
	
	cursor.lazyHighlightScale = lerp(cursor.lazyHighlightScale, cursor.highlightScale, 0.1);
	
	wrapperElement.style.setProperty('--cursorX', `${cursor.x}px`);
	wrapperElement.style.setProperty('--cursorY', `${cursor.y}px`);
	wrapperElement.style.setProperty('--lazyCursorX', `${cursor.lazyX}px`);
	wrapperElement.style.setProperty('--lazyCursorY', `${cursor.lazyY}px`);
	
	wrapperElement.style.setProperty('--cursorHighlightScale', cursor.lazyHighlightScale);
}

animate();

wrapperElement.addEventListener('mouseenter', onMouseEnter);
wrapperElement.addEventListener('mouseleave', onMouseLeave);
wrapperElement.addEventListener('mousemove', onMouseMove);
