import {
    motion,
    useMotionTemplate,
    useSpring,
    useTransform,
    type MotionValue,
} from 'framer-motion';
import '../../css/aurora.css';

interface AuroraProps {
    scrollYProgress?: MotionValue<number>;
    mouseX: MotionValue<number>;
    mouseY: MotionValue<number>;
}

export default function Aurora({
    scrollYProgress,
    mouseX,
    mouseY,
}: AuroraProps) {
    const smoothMouseX = useSpring(mouseX, { damping: 40, stiffness: 300 });
    const smoothMouseY = useSpring(mouseY, { damping: 40, stiffness: 300 });

    const opacity = useTransform(
        [mouseX, mouseY],
        ([x, y]) => 1 - (x ** 2 + y ** 2) * 0.7,
    );

    const y = scrollYProgress
        ? useTransform(scrollYProgress, [0, 1], ['0%', '50%'])
        : '0%';

    const transform = useMotionTemplate`translate3d(calc(-50% + ${smoothMouseX}px * 40), calc(-50% + ${smoothMouseY}px * 40), 0) translateY(${y})`;

    return (
        <motion.div
            style={{ opacity, transform }}
            className="pointer-events-none fixed left-1/2 top-1/2 -z-10 h-[800px] w-[800px] max-w-none -translate-x-1/2 -translate-y-1/2"
            aria-hidden="true"
        >
            <div className="aurora-bg absolute -left-1/2 -top-1/2 h-[200%] w-[200%] overflow-hidden"></div>
        </motion.div>
    );
}
