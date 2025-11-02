import {
    motion,
    useMotionTemplate,
    useSpring,
    useTransform,
    type MotionValue,
} from 'framer-motion';

interface NebulaProps {
    scrollYProgress?: MotionValue<number>;
    mouseX: MotionValue<number>;
    mouseY: MotionValue<number>;
}

export default function Nebula({
    scrollYProgress,
    mouseX,
    mouseY,
}: NebulaProps) {
    const smoothMouseX = useSpring(mouseX, {
        damping: 25,
        stiffness: 200,
    });
    const smoothMouseY = useSpring(mouseY, {
        damping: 25,
        stiffness: 200,
    });

    const opacity = useTransform(
        [mouseX, mouseY],
        ([x, y]) => 1 - (x ** 2 + y ** 2) * 0.5,
    );

    const y = scrollYProgress
        ? useTransform(scrollYProgress, [0, 1], ['0%', '50%'])
        : '0%';

    const transform = useMotionTemplate`translate3d(calc(-50% + ${smoothMouseX}px * 50), calc(-50% + ${smoothMouseY}px * 50), 0) translateY(${y})`;

    return (
        <motion.div
            style={{ opacity, transform }}
            className="pointer-events-none fixed left-1/2 top-1/2 -z-10 h-[800px] w-[800px] max-w-none -translate-x-1/2 -translate-y-1/2"
            aria-hidden="true"
        >
            <div className="nebula-bg absolute -left-1/2 -top-1/2 h-[200%] w-[200%] overflow-hidden"></div>
        </motion.div>
    );
}
